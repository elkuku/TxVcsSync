<?php defined('_JEXEC') || die('=;)');
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 30.12.11
 * Time: 21:03
 * To change this template use File | Settings | File Templates.
 */

//@todo JForm ¿
//var_dump($this->item);
?>

<h2><?= ($this->item->id_resource) ? 'Edit Resource' : 'New Resource' ?></h2>

<form action="index.php?task=resource.save" method="post">
    <label for="filename">Filename</label>
    <input type=text name="filename" id="filename" size="30" value="<?= $this->item->filename ?>" />
    <br />

    <label for="tx_rel_path">Tx rel Path</label>
    <input type=text name="tx_rel_path" id="tx_rel_path" size="40" value="<?= $this->item->tx_rel_path ?>" /> *
    <br />

    <label for="vcs_rel_path">VCS rel Path</label>
    <input type=text name="vcs_rel_path" id="vcs_rel_path" size="40" value="<?= $this->item->vcs_rel_path ?>" /> *
    <br />

    <label>Id:</label><?= $this->item->id_resource ?>
    <input type=hidden name="id_resource" value="<?= $this->item->id_resource ?>" />
    <input type=hidden name="id_project" value="<?= $this->item->id_project ?>" />
    <br />

    <input type="button" value="Cancel" onclick="window.location='index.php?id_project=<?= $this->item->id_project ?>'" />
    <input type="submit" value="Save" />
</form>
