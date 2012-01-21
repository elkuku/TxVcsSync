<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 30.12.11
 * Time: 20:39
 * To change this template use File | Settings | File Templates.
 */
jimport('joomla.application.component.modellist');

class TxVcsSyncModelResources extends JModelList
{
    public function __construct($config = array())
    {
        parent::__construct($config);

        //@todo deprecate soonish..
        $this->db = $this->_db;
    }//function

    protected function getListQuery()
    {
        $query = $this->db->getQuery(true)
            ->from('#__resources AS a')
            ->select('a.*')
            ->select('a.'.$this->getTable('Resource')->getKeyName().' AS id');

        return $query;
    }//function

    public function XXXgetProject()
    {
        return JModel::getInstance('Project', 'TxVcsSyncModel')
            ->getItem(JRequest::getInt('id_project'));
    }

}//class
