<?php defined('_JEXEC') || die('=;)');
/**
 * @package    Phonebook
 * @subpackage Base
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

jimport('joomla.application.component.controller');

/**
 * L0gVi3w Controller.
 *
 * @package    TxVcsSync
 * @subpackage Controllers
 */
class TxVcsSyncControllerResource extends JController
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
        $data['id_resource'] = $input->get('id_resource', null, 'int');
        $data['id_project'] = $input->get('id_project', null, 'int');
        $data['language'] = $input->get('language', '', 'html');
        $data['filename']  = $input->get('filename', '', 'html');
        $data['tx_rel_path'] = $input->get('tx_rel_path', '', 'html');
        $data['vcs_rel_path'] = $input->get('vcs_rel_path', '', 'html');

        try
        {
            /* @var $model TxVcsSyncModelResource */
            $model = $this->getModel('Resource');

            $model->save($data);

            JFactory::getApplication()->enqueueMessage(
                sprintf('The Resource %s has been saved.', $data['filename']));
        }
        catch(Exception $e)
        {
            // Validation failed - go back to edit view, preserving the data

            JFactory::getApplication()->enqueueMessage($e->getMessage(), 'error');

            $model->setState('data', $data);

            /* @var $view TxVcsSyncViewResource */
            $view = $this->getView('Resource', 'html');

            $view->setModel($model, true);

            $view->display();
        }

        parent::display();

        return $this;
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

        /* @var $model TxVcsSyncModelResource */
        $model = $this->getModel('Resource');

        if(!$model->delete($id))
        {
            JFactory::getApplication()->enqueueMessage($model->getError(), 'error');
        }
        else
        {
            JFactory::getApplication()->enqueueMessage('Your Resource has been deleted.');
        }

        parent::display();
    }

    public function update()
    {
        $project = $this->getModel('Project')->getItem();

        $resource = $this->getModel('Resource')->getItem();

        $lang = JRequest::getCmd('lang');
        $changes = JRequest::getVar('changes', array());

        $txFile = TxVcsHelper::readFile($project, $resource, $lang, 'tx');
        $vcsFile = TxVcsHelper::readFile($project, $resource, $lang, 'vcs');

        foreach($changes as $key => $from)
        {
            switch($from)
            {
                case 'tx' :
                    $vcsFile->strings[$key] = $txFile->strings[$key];
                    if(array_key_exists($key, $vcsFile->strings))
                        {
                    }
                    else
                    {

                    }
                    break;

                case 'vcs' :
                    $txFile->strings[$key] = $vcsFile->strings[$key];
            }
        }

        TxVcsHelper::writeFile($txFile);
        TxVcsHelper::writeFile($vcsFile);

        var_dump($_REQUEST);

        parent::display();
    }

}//class
