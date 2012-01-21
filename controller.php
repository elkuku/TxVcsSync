<?php defined('_JEXEC') || die('=;)');
/**
 * @package    TxVcsSync
 * @subpackage Base
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

jimport('joomla.application.component.controller');

/**
 * TxVcsSync Controller.
 *
 * @package    TxVcsSync
 * @subpackage Controllers
 */
class TxVcsSyncController extends JController
{
	/**
	 * Save a record.
	 *
	 * @return TxVcsSyncController
	 */
	public function save()
	{
		$input = new JInput;

        $data = array();
        $data['id_project'] = $input->get('id_project', null, 'int');
        $data['name']  = $input->get('name', '', 'html');
        $data['tx_path'] = $input->get('tx_path', '', 'html');
        $data['vcs_path'] = $input->get('vcs_path', '', 'html');
        $data['languages'] = $input->get('languages', '', 'html');

        try
        {
            /** @var $model TxVcsSyncModelProject */
            $model = $this->getModel('Project');

            $model->save($data);

            JFactory::getApplication()->enqueueMessage(
                sprintf('The Project %s has been saved.', $data['name']));
        }
        catch(Exception $e)
        {
            // Validation failed - go back to edit view, preserving the data

            JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');

            $model->setState('data', $data);

            $view = $this->getView('project', 'html');

            $view->setModel($model, true);

            $view->display();

            return $this;
        }

		parent::display();
	}

	/**
	 * Delete a record.
	 *
	 * @throws Exception
	 */
	public function delete()
	{
		$input = new JInput;

		$id = $input->get('id', 0, 'int');

		if(!$id)
			throw new Exception(__METHOD__.' - Empty id');

		/* @var $model TxVcsSyncModelProject */
		$model = $this->getModel('Project');

		if(!$model->delete($id))
		{
			JFactory::getApplication()->enqueueMessage($model->getError(), 'error');
		}
		else
		{
			JFactory::getApplication()->enqueueMessage('Your Project has been deleted.');
		}

		parent::display();
	}

}//class
