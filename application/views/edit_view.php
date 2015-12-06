<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 16.11.2015 г.
 * Time: 20:56 ч.
 */
/*$now = time();
echo unix_to_human($now); // U.S. time, no seconds
echo unix_to_human($now, TRUE, 'eu'); // Euro time with seconds*/
?>
<div class="edit col-md-12">
    <h2 class="page-header">New Post</h2>

    <div class="msg">
        <?php if ($this->session->flashdata( 'success_post_update' )) { ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata( 'success_post_update' ); ?>
            </div>
        <?php }
        if ($this->session->flashdata( 'success_post_add' )) { ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata( 'success_post_add' ); ?>
            </div>
        <?php }
        if (validation_errors()) { ?>
            <div class="alert alert-warning">
                <?php echo validation_errors(); ?>
            </div>
        <?php } ?>
    </div>

    <?php echo form_open_multipart( 'edit_post/submission' ); ?>
    <input type="hidden" name="id" value="<?php if (isset( $post )) echo $post->id; else echo 0; ?>"/>
    <table class="table custom">
        <tr>
            <th><label for="title">Title:</label></th>
            <td><input type="text" name="title" id="title" placeholder="Post title here..." autofocus="" required
                       value="<?php if (isset( $post )) {
                           echo $post->title;
                       } else echo set_value( 'title' ); ?>"></td>
        </tr>
        <tr>
            <th><label for="author">Author:</label></th>
            <td><input type="text" name="author" id="author" maxlength="30" required
                       value="<?php if (isset( $post )) {
                           echo $post->author;
                       } else echo $this->session->userdata( 'username' ); ?>"></td>
        </tr>
        <tr>
            <th><label for="date">Date:</label></th>
            <td><input type="text" name="date" id="date" required
                       value="<?php if (isset( $post )) {
                           echo $post->date;
                       } else echo date( "Y-m-d H:i" ); ?>"></td>
        </tr>
        <tr>
            <th><label for="body">Post:</label></th>
            <td>
                <textarea name="body" id="body" required><?php if (isset( $post )) {
                        echo $post->body;
                    } else echo set_value( 'body' ); ?><?php echo $this->ckeditor->editor( "body" ); ?></textarea>
            </td>
        </tr>
        <tr>
            <th><label for="pic">Picture:</label></th>
            <td><input type="file" name="pic" id="pic" value="<?php if (isset( $post )) {
                    echo $post->picture;
                } else echo set_value( 'picture' ); ?>">
                <img src="<?php if (isset( $post )) {
                    echo base_url() . "images/" . $post->picture;
                } else echo base_url() . "images/default.jpg" ?>"></td>
        </tr>
        <tr>
            <th></th>
            <td><input class="button" type="submit" value="Save">
                <input class="button" type="reset" value="Cancel">
            </td>
        </tr>
    </table>
    <?php echo form_close(); ?>
</div>