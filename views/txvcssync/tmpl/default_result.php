<?php defined('_JEXEC') || die('=;)');
/**
 * @package    TxVcsSync
 * @subpackage Views
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

require JPATH_BASE.'/helpers/DifferenceEngine.php';

$result = $this->result;

$lang = $result->lang;//  'de-DE';//@TODO lang selector..

$showAll = true;
$showAll = false;

$differences = 0;
?>
<h4><?= $result->filename ?></h4>
    <form action="index.php" method="post">

<table class="diff">
    <tr>
        <th style="width: 50%;">Transifex</th>
        <th style="width: 50%;">VCS</th>
    </tr>
    <?php
    foreach($result->strings as $string) :
        switch($string->status) :
            case 0 :
                //-- Equal strings
                if($showAll) : ?>
                    <tr>
                        <td><?= htmlspecialchars($string->txValue) ?></td>
                        <td><?= htmlspecialchars($string->vcsValue) ?></td>
                    </tr>
<?php

                endif;
                continue;
                break;
            case 1 :
                //-- Translation change
                echo JHtml::_('TxVcs.DiffRow', $string->key, $string->txValue, $string->vcsValue);
                $differences ++;
                break;
            case 2:
                //-- Not found in VCS
                echo JHtml::_('TxVcs.displayRow', $string->key, $string->txValue, $string->vcsValue);
                $differences ++;
                break;
            case 3:
                //-- Not found in Tx
                echo JHtml::_('TxVcs.displayRow', $string->key, $string->txValue, $string->vcsValue);
                $differences ++;
                break;
            default :
                echo 'unknown status';
                var_dump($string);
                $differences ++;
                break;
        endswitch;
    endforeach;
    ?>

</table>
        <?php //var_dump($this->result); ?>
        <input type="hidden" name="task" value="resource.update">
        <input type="hidden" name="id_project" value="<?= $this->project->id ?>">
        <input type="hidden" name="id_resource" value="<?= $this->result->id_resource ?>">
        <input type="hidden" name="lang" value="<?= $lang ?>">
<input type="submit" value="Submit" />
    </form>

<?php if(0 == $differences) : ?>
    <h3 class="identical">The files are identical</h3>
<?php endif; ?>
