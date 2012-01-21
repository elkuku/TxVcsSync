<?php defined('_JEXEC') || die('=;)');
/**
 * @package    TxVcsSync
 * @subpackage Views
 * @author     Nikolai Plath - elkuku
 * @author     Created on 17-Jul-2011
 * @license    GNU/GPL
 */

$i = 0;
?>

<h2><?= 'Project: '.$this->project->name ?></h2>

<strong>Tx Path: </strong><?= $this->project->tx_path ?>
<br />
<strong>VCS Path: </strong><?= $this->project->vcs_path ?>
<br />
<strong>Languages: </strong><?= $this->project->languages ?>

<div class="menuBar">
    <a class="command newResource" href="index.php?view=resource&id_project=<?= $this->project->id ?>">New Resource</a>
</div>

<h3>Resources</h3>

<table class="projects">
    <tr>
        <th>File</th>
        <th>Tx rel Path</th>
        <th>VCS rel Path</th>
        <th>ID</th>
        <th>Actions</th>
    </tr>
    <?php foreach($this->resources as $item) : ?>
    <tr class="row<?= $i ++ & 1 ? 1 : 0 ?>">
        <td>
            <a class="command select"
               href="index.php?id_project=<?= $this->project->id ?>&id_resource=<?= $item->id ?>">
                <?= $item->filename ?>
            </a>
        </td>
        <td><?= $item->tx_rel_path ?></td>
        <td><?= $item->vcs_rel_path ?></td>
        <td><?= $item->id ?></td>
        <td>
            <a class="command edit" href="index.php?view=resource&id=<?= $item->id ?>">Edit</a>&nbsp;
            <a class="command delete" href="index.php?task=resource.delete&id=<?= $item->id ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<?php if($this->result) : ?>
    <?= $this->loadTemplate('Result'); ?>
<?php endif; ?>
