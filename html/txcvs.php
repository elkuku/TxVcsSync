<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 20.01.12
 * Time: 05:04
 * To change this template use File | Settings | File Templates.
 */

class JHtmlTxCvs extends JHtml
{
    public static function projects($projects, $selected)
    {
        $options = array();

        $options[] = JHtml::_('select.option', '', 'Select a Project...');

        foreach($projects as $project)
        {
            $options[] = JHtml::_('select.option', $project->id_project, $project->name);
        }

        return JHtml::_('select.genericlist', $options, 'project', null, 'value', 'text', $selected);
    }
}
