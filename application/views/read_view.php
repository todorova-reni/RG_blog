<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 13:49 ч.
 */
?>
<div class="container col-md-12">
    <h2 class="col-md-12 post"><?php echo $post->title; ?></h2>

    <div class="info">
        <span><i class="fa fa-user"></i>Author: <?php echo ucfirst( $post->author ); ?></span>
        <span><i class="fa fa-calendar"></i>Posted on: <?php echo $post->date; ?></span>
        <span><i class="fa fa-eye"></i>Views: <?php echo $post->views; ?></span>
    </div>
    <img class="thumb col-md-12"
         src="<?php echo base_url(); ?>images/<?php echo isset( $post->picture ) ? $post->picture : 'default.jpg'; ?>">

    <p><?php echo $post->body; ?></p>
    <span class="share"><a
            href="http://www.facebook.com/share.php?u=http://www.blog-reni.dev/index.php/blog/read/<?php echo $post->id; ?>&title=$post->title"
            target="_blank"><img src="<?php echo base_url() . "images/icons/fb_share.png"; ?>"
                                 alt="Facebook"/></a></span>
    <span class="share"><a
            href="http://twitter.com/home?status=$post->title+http://www.blog-reni.dev/index.php/blog/read/<?php echo $post->id; ?>"
            target="_blank"><img src="<?php echo base_url() . "images/icons/tw_share.png"; ?>"
                                 alt="Facebook"/></a></span>
    <hr class="grey">

    <div class=" col-md-12 comment">
        <div class="col-md-10">
            <?php if ($this->session->flashdata( 'success_comment' )) { ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata( 'success_comment' ); ?>
                </div>
            <?php }
            if ($this->session->flashdata( 'error_comment' )) { ?>
                <div class="alert alert-warning">
                    <?php echo $this->session->flashdata( 'error_comment' ); ?>
                </div>
            <?php } ?>
        </div>
        <?php echo form_open( 'blog/submission/' . $post->id ); ?>
        <table class="custom">
            <tr>
                <?php if ($logged_in == false) { ?>
                    <th><textarea name="comment" disabled
                                  placeholder="Only registered users can write a comment. Please log in to continue."></textarea>
                    </th>
                    <td>
                        <button class="button"><?php echo anchor( 'login/login', 'Log in now' ); ?></button>
                    </td>
                <?php } else { ?>
                    <th><textarea name="comment"
                                  placeholder="Your comment must be at least 3 characters, otherwise it won`t be posted."></textarea>
                    </th>
                    <td><input class="button" type="submit" value="Publish"></td>
                <?php } ?>
            </tr>
        </table>
        <?php echo form_close(); ?>
    </div>
    <hr class="grey">
    <div class="comments">
        <?php foreach ($comments as $row) { ?>
            <div class="row">
                <div class="info">
                    <span><i class="fa fa-user"></i> <?php echo ucfirst( $row->author ); ?></span>
                    <span><i class="fa fa-calendar"></i> <?php echo $row->date; ?></span>
                </div>
                <p>
                    <?php echo $row->body; ?>
                </p>
            </div>
            <hr>
        <?php } ?>
    </div>
</div>