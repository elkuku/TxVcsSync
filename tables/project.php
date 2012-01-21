<?php
class TableProject extends TxVcsTable
{
	public function __construct($db)
	{
		parent::__construct('#__projects', 'id_project', $db);
	}//function

    public function check()
    {
        $errors = array();

        if(empty($this->name))
        {
            $errors[] =  'Please insert a project name.';
        }

        if(empty($this->tx_path)
        || empty($this->vcs_path))
        {
            $errors[] = 'Please specify the required paths';
        }


        if(count($errors))
            throw new Exception(implode('<br />', $errors));

        return $this;
    }//function

}//class
