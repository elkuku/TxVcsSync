<?php defined('_JEXEC') || die('=;)');
/**
 * @package    TxVcsSync
 * @subpackage Views
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */
?>

<div class="TxVcsSync">
    <?php if(false == $this->project || is_null($this->project->id)) : ?>
        <?= $this->loadTemplate('welcome') ?>
        <?= $this->loadTemplate('projects') ?>
    <?php else : ?>
        <?= $this->loadTemplate('resources') ?>
    <?php endif; ?>
</div>
