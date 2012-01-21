<?php
class TableResource extends TxVcsTable
{
	function __construct($db)
	{
		parent::__construct('#__resources', 'id_resource', $db);
	}//function

}//class
