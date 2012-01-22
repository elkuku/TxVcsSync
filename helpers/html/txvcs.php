<?php
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 20.01.12
 * Time: 05:04
 * To change this template use File | Settings | File Templates.
 */

class JHtmlTxVcs extends JHtml
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

    public static function diffRow($key, $v1, $v2)
    {
        $html = array();

        $diffFormatter = new WordLevelDiff(
            array(htmlspecialchars($v1))
            , array(htmlspecialchars($v2))
        );

        $orig = $diffFormatter->orig();
        $closing = $diffFormatter->closing();

        $html[] = '<tr class="diffRow">';
        $html[] = '<td class="diff-deletedline">'.$orig[0].'</td>';
        $html[] = '<td class="diff-addedline">'.$closing[0].'</td>';
        $html[] = '</tr>';

        $html[] = self::diffCommandRow($key);

        return implode("\n", $html);
    }

    public static function displayRow($key, $v1, $v2)
    {
        $html = array();

        $class1 =($v1) ? 'diff-deletedline' : 'notFound';
        $class2 =($v2) ? 'diff-deletedline' : 'notFound';

        $html[] = '<tr class="diffRow">';
        $html[] = '<td class="'.$class1.'">'.htmlspecialchars($v1).'</td>';
        $html[] = '<td class="'.$class2.'">'.htmlspecialchars($v2).'</td>';
        $html[] = '</tr>';

        $html[] = self::diffCommandRow($key);

        return implode("\n", $html);
    }

    public static function diffCommandRow($key)
    {
        $html = array();
        $html[] = '<tr class="diffCommands"><td colspan="2" class="diffCommands">';

        $html[] = '<input type="radio" id="changes['.$key.'][tx]" name="changes['.$key.']" value="tx">';
        $html[] = '<label for="changes['.$key.'][tx]">Copy to VCS &rArr;</label>';

        $html[] = '<input type="radio" id="changes['.$key.'][no]" name="changes['.$key.']" value="no">';
        $html[] = '<label for="changes['.$key.'][no]">don\'t know yet</label>';

        $html[] = '<input type="radio" id="changes['.$key.'][vcs]" name="changes['.$key.']" value="vcs">';
        $html[] = '<label for="changes['.$key.'][vcs]">&lArr; Copy to Tx</label>';

        $html[] = '</td></tr>';

        return implode("\n", $html);

    }
}
