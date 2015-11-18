<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 13:49 ч.
 */
?>
<div class="container col-md-12">
         <h2 class="col-md-12 post"><?php echo $post->title;?></h2>
        <div class="info">
            <span><i class="fa fa-user"></i>Author: <?php echo $post->author;?></span>
            <span><i class="fa fa-calendar"></i>Posted on: <?php echo $post->date;?></span>
            <span><i class="fa fa-eye"></i>Views: <?php echo $post->views;?></span>
        </div>
    <img  class="thumb col-md-12" src="<?php echo base_url();?>images/<?php echo $post->picture;?>">
    <p><?php echo $post->body;?></p>
</div>