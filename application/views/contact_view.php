<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 10.11.2015 г.
 * Time: 15:37 ч.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Contact</title>

    <style type="text/css">

        ::selection{ background-color: #E13300; color: white; }
        ::moz-selection{ background-color: #E13300; color: white; }
        ::webkit-selection{ background-color: #E13300; color: white; }

        body {
            background-color: #dddddd;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
            margin: 40px;
        }

        a {
            color: #003399;
            background-color: transparent;
            font-weight: normal;
        }

        h1 {
            color: #444;
            background-color: transparent;
            border-bottom: 1px solid #D0D0D0;
            font-size: 19px;
            font-weight: normal;
            text-align: center;
            margin: 0 0 14px 0;
            padding: 14px 15px 10px 15px;
        }

        code {
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
            font-size: 12px;
            background-color: #f9f9f9;
            border: 1px solid #D0D0D0;
            color: #002166;
            display: block;
            margin: 14px 0 14px 0;
            padding: 12px 10px 12px 10px;
        }

        #body{
            margin: 0 15px 0 15px;
        }

        p.footer{
            text-align: right;
            font-size: 11px;
            border-top: 1px solid #D0D0D0;
            line-height: 32px;
            padding: 0 10px 0 10px;
            margin: 20px 0 0 0;
        }

        #container{
             width: 960px;
            margin: 0 auto;
            background-color: #ffffff;
            -webkit-box-shadow: 0 0 8px #D0D0D0;
        }
        form{
            width: 400px;
            margin: 0 auto;
            text-align: center;
        }
        table{
            width: 50%;
        }
        table tr{
            height: 30px;
        }
        table th label{
            width: 100px;
            font-size: 15px;
        }
        table tr input{
            width: 99%
        }
        table tr textarea{
            width: 250px;
        }
        form .button {
            width: 100px;
            height: 30px;
            margin-left: 25px;
            font-size: 17px;
            border: 1px solid #444444;
            border-radius: 5px;
        }
        div.msg{
            width: 300px;
            margin: 0 auto;
            padding: 10px 15px;
            font: oblique 15px Arial;
            border: 1px solid #dddddd;
        }
        div.error{
            color: red;
        }
        div.success{
            padding: 20px;
            color: green;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Contact Form</h1>
        <div class="jsError"></div>
        <div id="body">
            <?php echo form_open('contact/submission', array('class' => 'jsform'));?>
                <table>
                    <tr>
                        <th><label for="name">Name: </label></th>
                        <td><input type="text" name="name" id="name" maxlength="30" required placeholder="Your name here..."></td>
                    </tr>
                    <tr>
                        <th><label for="tel">Phone: </label></th>
                        <td><input type="tel" name="tel" id="tel" size="10" required placeholder="Your phone number..."></td>
                    </tr>
                    <tr>
                        <th><label for="email">Email: </label></th>
                        <td><input type="email" name="email" id="email" maxlength="30" required placeholder="Your Email address..."></td>
                    </tr>
                    <tr>
                        <th><label for="mssg">Message: </label></th>
                        <td><textarea name="mssg" id="mssg" placeholder="Type your message here..." required></textarea></td>
                    </tr>
                </table>
            <input class="button" type="submit" value="Send">
            <input class="button" type="reset" value="Cancel">
            <?php echo form_close();?>

           <!-- <div class="list">

                <?php foreach ($rows as $row) {?>
                    <p>№:&#32;<?php echo $row->id; ?></p>
                    <p>Name:&#32;<?php echo $row->name; ?></p>
                    <p>Tel:&#32;<?php echo $row->phone; ?></p>
                    <p>Email:&#32;<?php echo $row->email; ?></p>
                    <p>Message:&#32;<?php echo $row->message; ?></p>
                    <hr />
                <?php }?>
           </div>-->
        </div>

        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('form.jsform').on('submit',function(form){
            form.preventDefault();
            $.post('../index.php/Contact/submission', $('form.jsform').serialize(), function(data){
                $('div.jsError').html(data);
            });
        });
    });
</script>
</html>