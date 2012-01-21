<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 20.01.12
 * Time: 21:26
 * To change this template use File | Settings | File Templates.
 */

class TxVcsTable extends JTable
{
    /**
     * Set the hardcorecoded ( ;) ) member 'id' to the value of the table key field.
     *
     * @param   string     $table  Name of the table to model.
     * @param   string     $key    Name of the primary key field in the table.
     * @param   JDatabase  &$db    JDatabase connector object.
     */
    public function __construct($table, $key, $db)
    {
        parent::__construct($table, $key, $db);

        $this->id = $this->$key;
    }

    public function load($keys = null, $reset = true)
    {
        if(parent::load($keys, $reset))
        {
            $this->id = $this->{$this->_tbl_key};
        }
        else
        {
            //-- urgs legacy error handling - wtf :P
            //$this->setError()

            return false;

        }

        return $this;
    }

    /**
     * Set the primary key to 'null' if it is '0' prior to save for database driver compliance.
     *
     * @param   mixed   $src             An associative array or object to bind to the JTable instance.
     * @param   string  $orderingFilter  Filter for the order updating
     * @param   mixed   $ignore          An optional array or space separated list of properties
     * to ignore while binding.
     *
     * @return  JTable
     *
     * @link	http://docs.joomla.org/JTable/save
     */
    public function XXXsave($src, $orderingFilter = '', $ignore = '')
    {
        if($this->_tbl_key == 0)
            $this->_tbl_key = null;

        unset($this->id);

        return parent::save($src, $orderingFilter = '', $ignore = '');
    }

    /**
     * Method to store a row in the database from the JTable instance properties.
     * If a primary key value is set the row with that primary key value will be
     * updated with the instance property values.  If no primary key value is set
     * a new row will be inserted into the database with the properties from the
     * JTable instance.
     *
     * @param   boolean  $updateNulls  True to update fields even if they are null.
     *
     * @return  boolean  True on success.
     *
     * @link	http://docs.joomla.org/JTable/store
     * @since   11.1
     */
    public function store($updateNulls = false)
    {
        if(0 == $this->{$this->_tbl_key})
            $this->{$this->_tbl_key} = null;

        unset($this->id);

        return parent::store($updateNulls);
    }
}
