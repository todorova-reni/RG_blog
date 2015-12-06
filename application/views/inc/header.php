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
    <title><?= $title; ?></title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url( "assets/css/normalize.css" ); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url( "assets/css/bootstrap.css" ); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url( "assets/css/font-awesome.css" ); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url( "assets/css/style.css" ); ?>"/>

</head>
<body>
<div class="container-fluid wrapper col-md-12 ">
    <header>

        <nav role="navigation" class=" menu navbar navbar-default col-md-8">
            <div class="navbar-header">
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbarCollapse" class="collapse navbar-collapse">
                <ul class=" nav navbar-nav navbar-right">
                    <li><a href="<?php echo site_url(); ?>welcome">Home</a></li>
                    <li><a href="<?php echo site_url(); ?>blog">Blog</a></li>
                    <li><a href="<?php echo site_url(); ?>contact">Contact</a></li>
                    <?php if ($logged_in == false) { ?>
                        <li><a href="<?php echo site_url(); ?>login">Login</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo site_url(); ?>edit_post">Add Post</a></li>
                        <?php if ($is_admin == true) { ?>
                            <li><a href="<?php echo site_url(); ?>admin">Admin Panel</a></li>
                        <?php } ?>
                        <li><a href="<?php echo site_url(); ?>login/logout">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>

        </nav>
    </header>
    <div class="red content container col-md-8 ">


