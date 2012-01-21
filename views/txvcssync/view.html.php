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
class TxVcsSyncViewTxVcsSync extends JView
{
    protected $projects = array();
    protected $resources = array();
    protected $project = null;

    /**
     * L0gVi3w view display method.
     *
     * @param string $tpl The name of the template file to parse;
     *
     * @return void
     */
    public function display($tpl = null)
    {
        $this->projects = $this->get('items');
        $this->project = $this->get('project');
        $this->resources = $this->get('resources');
        $this->result = $this->get('Result');

        if(!count($this->projects))
        {
            JFactory::getApplication()->enqueueMessage(
                'Please create a project.'
                , 'warning');
        }

        parent::display($tpl);
    }

}
