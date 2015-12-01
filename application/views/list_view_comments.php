<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 1.12.2015 г.
 * Time: 15:29 ч.
 */
?>
<div class="edit col-md-12">
    <h2 class="page-header"><?= $heading ?></h2>

    <table class="table table-striped">
        <tr>
            <th>№</th>
            <th>Comment</th>
            <th>Post</th>
            <th>Author</th>
            <th>Date</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row->number; ?></td>
                <td class="text"><?php echo $row->comment; ?></td>
                <td><?php echo anchor( 'blog/read/' . $row->id_post, 'Post' ); ?></td>
                <td><?php echo $row->author; ?></td>
                <td><?php echo $row->date; ?></td>
                <td><?php echo anchor( 'admin/deleteComment/' . $row->number, 'Delete' ); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>