<?php defined('_JEXEC') || die('=;)');
/**
 * @package    TxVcsSync
 * @subpackage Views
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

require JPATH_BASE.'/html/DifferenceEngine.php';

$lang = 'de-DE';//@TODO lang selector..

$result = $this->result[$lang];
$differences = 0;
?>
<h4><?= $result->filename ?></h4>
<table class="diff">
    <tr>
        <th colspan="2">Transifex</th>
        <th colspan="2">VCS</th>
    </tr>
    <?php
    foreach($result->strings as $string) :
        //var_dump($result);
        switch($string->status) :
            case 0 :
                //-- Equal strings
                continue;
                break;
            case 1 :
                //-- Translation change
                $dwFormatter = new TableDiffFormatter;
                $dwDiff = new Diff(
                    array(htmlspecialchars($string->txValue))
                    , array(htmlspecialchars($string->vcsValue)));
                echo $dwFormatter->format($dwDiff);

                $differences ++;

                break;
            case 2:
                //-- Not found
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

<?php if(0 == $differences) : ?>
    <h3 class="identical">The files are identical</h3>
<?php endif; ?>
