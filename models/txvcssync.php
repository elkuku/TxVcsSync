<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 30.12.11
 * Time: 20:39
 * To change this template use File | Settings | File Templates.
 */
jimport('joomla.application.component.modellist');

class TxVcsSyncModelTxVcsSync extends JModelList
{
    public function __construct($config = array())
    {
        parent::__construct($config);

        //@todo deprecate soonish..
        $this->db = $this->_db;
    }

    protected function getListQuery()
    {
        $query = $this->db->getQuery(true)
            ->from('#__projects AS a')
            ->select('a.*')
            ->select('a.'.$this->getTable('Project')->getKeyName().' AS id');

        return $query;
    }

    public function getProject()
    {
        return JModel::getInstance('Project', 'TxVcsSyncModel')
            ->getItem(JRequest::getInt('id_project'));
    }

    public function getResources()
    {
        return JModel::getInstance('Resources', 'TxVcsSyncModel')
            ->getItems();
    }

    public function getResult()
    {
        $project = $this->getProject();
        $resource = JModel::getInstance('Resource', 'TxVcsSyncModel')
            ->getItem();

        if(!isset($resource->id)
            || is_null($resource->id)
            || !$resource->filename
        )
            return array();

        $langs = explode(',', $project->languages);

        $results = array();

        foreach($langs as $lang)
        {
            $pathVcs = JPATH_BASE.'/'.$project->vcs_path.'/'.$resource->vcs_rel_path.'/'.$resource->filename;
            $pathTx = JPATH_BASE.'/'.$project->tx_path.'/'.$resource->tx_rel_path.'/'.$resource->filename;

            $pathVcs = str_replace('[lang]', $lang, $pathVcs);
            $pathTx = str_replace('[lang]', $lang, $pathTx);

            $originals = (file_exists($pathVcs)) ? parse_ini_file($pathVcs) : array();
            $translations = (file_exists($pathTx)) ? parse_ini_file($pathTx) : array();

            $strings = array();

            foreach($translations as $key => $value)
            {
                $r = new stdClass;
                $r->key = $key;
                $r->txValue = $value;
                $r->vcsValue = '';

                if(array_key_exists($key, $originals))
                {
                    $r->vcsValue = $originals[$key];
                    $r->status = ($r->txValue == $r->vcsValue) ? 0 : 1;

                }
                else
                {
                    $r->status = 2;
                }

                $strings[] = $r;
            }

            /*
            * Back check the VCS version - just in case..
            */
            foreach($originals as $key => $value)
            {
                if(array_key_exists($key, $translations))
                    continue;

                $r = new stdClass;
                $r->key = $key;
                $r->txValue = '';
                $r->vcsValue = $value;
                $r->status = 3;

                $strings[] = $r;
            }

            $result = new stdClass;
            $result->filename = str_replace('[lang]', $lang, $resource->filename);
            $result->pathVcs = $pathVcs;
            $result->pathTx = $pathTx;

            $result->strings = $strings;

            $results[$lang] = $result;
        }

        return $results;
    }

}//class
