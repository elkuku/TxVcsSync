<?php defined('_JEXEC') || die('=;)');
/**
 * Created by JetBrains PhpStorm.
 * User: elkuku
 * Date: 30.12.11
 * Time: 21:03
 * To change this template use File | Settings | File Templates.
 */

//@todo JForm ¿
?>

<h2><?= ($this->item->id_project) ? 'Edit Project' : 'New Project' ?></h2>

<form action="index.php?task=save" method="post">

	<label for="name">Project name</label>
	<input type=text name="name" id="name" value="<?= $this->item->name ?>" /> *
	<br />

	<label for="tx_path">Tx Path</label>
	<input type=text name="tx_path" id="tx_path" value="<?= $this->item->tx_path ?>" />
	<br />

	<label for="vcs_path">VCS Path</label>
	<input type=text name="vcs_path" id="vcs_path" value="<?= $this->item->vcs_path ?>" /> *
	<br />

    <label for="languages">Languages</label>
    <input type=text name="languages" id="languages" value="<?= $this->item->languages ?>" /> *
    <br />

	<label>Id:</label><?= $this->item->id_project ?>
	<input type=hidden name="id_project" value="<?= $this->item->id_project ?>" />
	<br />

	<input type="button" value="Cancel" onclick="window.location='index.php'" />
	<input type="submit" value="Save" />
</form>
