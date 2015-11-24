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
    <div class="msg error">
        <?php echo validation_errors(); ?>
    </div>
    <p class="new"><button class="button"><?php echo anchor('edit_post/getList/','List View');?></button></p>

    <?php echo form_open_multipart('edit_post/submission') ;?>
    <input type="hidden" name="id" value="<?php if (isset($post)) echo $post->id; else echo 0;?>" />
    <table class="table custom">
        <tr>
            <th><label for="title">Title:</label></th>
            <td><input type="text" name="title" id="title" placeholder="Post title here..." autofocus="" required value="<?php if (isset($post)) {echo $post->title;} else echo set_value('title'); ?>"></td>
        </tr>
        <tr>
            <th><label for="author">Author:</label></th>
            <td><input type="text" name="author" id="author" placeholder="Post`s author here..." maxlength="30" required value="<?php if (isset($post)) {echo $post->author;} else echo set_value('author'); ?>"></td>
        </tr>
        <tr>
            <th><label for="date">Date:</label></th>
            <td><input type="text" name="date" id="date" value="<?php echo date("Y-m-d H:i")?>" required value="<?php if (isset($post)) {echo $post->date;} else echo set_value('date'); ?>"></td>
        </tr>
        <tr>
            <th><label for="body">Post:</label></th>
            <td>
                <textarea name="body" id="body" required ><?php if (isset($post)) {echo $post->body;} else echo set_value('body');?><?php echo $this->ckeditor->editor("body","Post body here");?></textarea></td>
        </tr>
        <tr>
            <th><label for="pic">Picture:</label></th>
            <td><input type="file" name="pic" id="pic" required value="<?php if (isset($post)) {echo $post->picture;} else echo set_value('picture'); ?>">
            <img src="<?php  if (isset($post)) {echo base_url()."images/".$post->picture; } else echo base_url()."images/default.jpg" ?>"></td>
        </tr>
        <tr>
           <th></th>
            <td><input class="button" type="submit" value="Save">
                <input class="button" type="reset" value="Cancel">
            </td>
        </tr>
    </table>
    <?php echo form_close();?>
</div>