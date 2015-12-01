<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 1.12.2015 г.
 * Time: 15:27 ч.
 */
?>
<div class="edit col-md-12">
    <h2 class="page-header"><?= $heading ?></h2>

    <table class="table table-striped">
        <tr>
            <th>№</th>
            <th>Username</th>
            <th>Email</th>
            <th>Date</th>
            <th>Admin</th>
            <th>Activated</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->username ?></td>
                <td><?php echo $row->email; ?></td>
                <td><?php echo $row->reg_date; ?></td>
                <td><?php echo $row->is_admin; ?></td>
                <td><?php echo $row->activated; ?></td>
                <td><?php echo anchor( 'admin/deleteUser/' . $row->id, 'Delete' ); ?></td>
            </tr>
        <?php } ?>
    </table>
</div>