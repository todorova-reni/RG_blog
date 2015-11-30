<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 13:44 ч.
 */

?>
<div class="col-md-12">
    <h2 class="page-header">Welcome To My Blog</h2>
<?php foreach($query->result() as $row) {?>
    <div class="row">
        <img class="col-md-6 thumb" src="<?php echo base_url();?>images/<?php echo $row->picture;?>">

        <h3 class="title col-md-6">
            <b><?php echo anchor('blog/read/'.$row->id, $row->title); ?></b>
        </h3>
        <div class="info">
            <span><i class="fa fa-user"></i> <?php echo $row->author;?></span>
            <span><i class="fa fa-calendar"></i> <?php echo $row->date;?></span>
        </div>
        <p>
            <?php
            $string = word_limiter(($row->body),85);
            echo $string. anchor('blog/read/'.$row->id, ' Read more...');
            ?>
        </p>
    </div>
    <hr>
<?php }?>

    <div class="col-md-12 pagination"><?php echo $this->pagination->create_links();?></div>
</div>