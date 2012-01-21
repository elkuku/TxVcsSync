<?php defined('_JEXEC') || die('=;)');
/**
 * @package    TxVcsSync
 * @subpackage Views
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

//-- Import the JView class
jimport('joomla.application.component.view');

/**
 * HTML View class for the TxVcsSync Component.
 *
 * @package TxVcsSync
 */
class TxVcsSyncViewProject extends JView
{
	protected $items = array();

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

		if(false == $this->item)
			throw new Exception('Invalid item');

		parent::display($tpl);
	}//function

}//class
