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

<div class="menuBar">
    <a class="command newProject" href="index.php?view=project">New Project</a>
</div>

<table class="projects">
    <tr>
        <th>Project</th>
        <th>Languages</th>
        <th>Tx Path</th>
        <th>VCS Path</th>
        <th>ID</th>
        <th>Actions</th>
    </tr>
    <?php foreach($this->projects as $item) : ?>
    <tr class="row<?= $i ++ & 1 ? 1 : 0 ?>">
        <td>
            <a class="command select"
               href="index.php?id_project=<?= $item->id ?>">
                <?= $item->name ?>
            </a>
        </td>
        <td><?= $item->languages ?></td>
        <td><?= $item->tx_path ?></td>
        <td><?= $item->vcs_path ?></td>
        <td><?= $item->id ?></td>
        <td>
            <a class="command edit" href="index.php?view=project&id=<?= $item->id ?>">Edit</a>&nbsp;
            <a class="command delete" href="index.php?task=delete&id=<?= $item->id ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
