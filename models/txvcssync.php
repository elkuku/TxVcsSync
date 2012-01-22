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

        $langs = explode(',', $project->languages);
        $lang = JRequest::getCmd('lang', 'de-DE');

        $lang = (in_array($lang, $langs)) ? $lang : 'de-DE';

        $resource = JModel::getInstance('Resource', 'TxVcsSyncModel')
            ->getItem();

        if( ! isset($resource->id) || is_null($resource->id) || ! $resource->filename)
            return array();

        $vcsFile = TxVcsHelper::readFile($project, $resource, $lang, 'vcs');
        $txFile = TxVcsHelper::readFile($project, $resource, $lang, 'tx');

        $strings = array();

        foreach($txFile->strings as $key => $value)
        {
            $r = new stdClass;
            $r->key = $key;
            $r->txValue = $value;
            $r->vcsValue = '';

            if(array_key_exists($key, $vcsFile->strings))
            {
                $r->vcsValue = $vcsFile->strings[$key];
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
        foreach($vcsFile->strings as $key => $value)
        {
            if(array_key_exists($key, $txFile->strings))
                continue;

            $r = new stdClass;
            $r->key = $key;
            $r->txValue = '';
            $r->vcsValue = $value;
            $r->status = 3;

            $strings[] = $r;
        }

        $result = new stdClass;
        $result->id_resource = $resource->id;
        $result->lang = $lang;
        $result->filename = str_replace('[lang]', $lang, $resource->filename);
        $result->pathVcs = $vcsFile->path;
        $result->pathTx = $txFile->path;

        $result->strings = $strings;

        return $result;
    }

}//class
