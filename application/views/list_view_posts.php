<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 16:40 ч.
 */
?>
<div class="edit col-md-12">
    <h2 class="page-header"><?= $heading ?></h2>

    <table class="table table-striped">
        <tr>
            <th>№</th>
            <th>Post</th>
            <th>Author</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo anchor( 'blog/read/' . $row->id, $row->title ); ?></td>
                <td><?php echo $row->author; ?></td>
                <td><?php echo $row->date; ?></td>
                <td><?php echo anchor( 'edit_post/index/' . $row->id, 'Edit' ); ?></td>
                <td><?php echo anchor( 'edit_post/delete/' . $row->id, 'Delete' ); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>