<?php defined('_JEXEC') || die('=;)');
/**
 * @package    L0gVi3w
 * @subpackage Views
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

//-- Import the JView class
jimport('joomla.application.component.view');

/**
 * HTML View class for the L0gVi3w Component.
 *
 * @package L0gVi3w
 */
class TxVcsSyncViewResource extends JView
{
	/**
	 * L0gVi3w view display method.
	 *
	 * @param string $tpl The name of the template file to parse;
	 *
	 * @return void
	 */
	public function display($tpl = null)
	{
		$this->item = $this->get('Item');
        $id_project = JRequest::getInt('id_project');

        if( ! $this->item->id_project)
            $this->item->id_project = $id_project;

        if( ! $this->item->id_project)
        {
            JFactory::getApplication()->enqueueMessage('No project given :(', 'error');

            return;
        }

		if(false == $this->item)
			throw new Exception('Invalid item');

		parent::display($tpl);
	}//function

}//class
