<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 12.11.2015 г.
 * Time: 21:32 ч.
 */
$message='';
?>

<html>
<head>
    <title>My Form</title>
</head>
<body>

<div class="msg error">
    <?php echo $message; ?>
    <?php echo validation_errors(); ?>
</div>


</body>
</html>