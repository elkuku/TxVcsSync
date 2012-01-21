<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 20.01.12
 * Time: 17:33
 * To change this template use File | Settings | File Templates.
 */

jimport('joomla.application.component.modeladmin');

/**
 * Project model.
 */
class TxVcsSyncModelAdmin extends JModelAdmin
{
    /**
     * Method to get a single record.
     *
     * @todo remove when switching to JForm
     *
     * @param   integer  $pk  The id of the primary key.
     *
     * @return  mixed    Object on success, false on failure.
     *
     * @since   11.1
     */
    public function getItem($pk = null)
    {
        $data = $this->state->get('data');

        if(is_array($data))
            return JArrayHelper::toObject($data);

        if( ! $pk)
            $pk = JRequest::getInt('id');

        return parent::getItem($pk);
    }

    public function getForm($data = array(), $loadData = true)
    {
        //-- Must be implemented @todo implement..
        return false;

        /*
          // Get the form.
          $form = $this->loadForm('com_projectman.project', 'project', array('control' => 'jform', 'load_data' => $loadData));
          if (empty($form)) {
              return false;
          }

          return $form;
          */
    }

    /**
     * Method to save the form data.
     *
     * @param   array  $data  The form data.
     *
     * @return boolean
     *
     * @throws Exception
     */
    public function save($data)
    {
        $table = $this->getTable();
        $key = $table->getKeyName();

        $pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');
        $isNew = true;

        if(0 === $data[$key])
            $data[$key] = null;

        if($pk > 0)
        {
            $table->load($pk);
            $isNew = false;
        }

        // Bind the data.
        if( ! $table->bind($data))
            throw new Exception($table->getError());

        // Prepare the row for saving
        $this->prepareTable($table);

        // Check the data.
        if( ! $table->check())
            throw new Exception($table->getError());

        // Store the data.
        if( ! $table->store())
            throw new Exception($table->getError());

        $pkName = $table->getKeyName();

        if (isset($table->$pkName))
        {
            $this->setState($this->getName() . '.id', $table->$pkName);
        }

        $this->setState($this->getName() . '.new', $isNew);

        return true;
    }

    /**
     * Method to delete one or more records.
     *
     * @param   array  &$pks  An array of record primary keys.
     *
     * @return  boolean  True if successful, false if an error occurs.
     *
     * @since   11.1
     */
    public function delete(&$pks)
    {
        // Initialise variables.
        $pks = (array) $pks;
        $table = $this->getTable();

        // Iterate the items to delete each one.
        foreach ($pks as $pk)
        {
            if($table->load($pk))
            {
                if( ! $table->delete($pk))
                {
                    $this->setError($table->getError());
                    return false;
                }
            }
            else
            {
                $this->setError($table->getError());
                return false;
            }
        }//foreach

        return true;
    }//function

}//class
