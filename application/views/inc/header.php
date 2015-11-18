<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 16.11.2015 г.
 * Time: 21:04 ч.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $title;?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/normalize.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/bootstrap.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/font-awesome.css"); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/style.css"); ?>" />

</head>
<body>
<div class="container-fluid wrapper col-md-12 ">
    <header>
        <nav>
            <ul class=" menu col-md-8">
                <li><a href="<?php echo site_url();?>/contact">Contact</a></li>
                <li><a href="<?php echo site_url();?>/edit_post">Edit</a></li>
                <li><a href="<?php echo site_url();?>/blog">Blog</a></li>
            </ul>
        </nav>
    </header>
    <div class="red content container col-md-8 ">


