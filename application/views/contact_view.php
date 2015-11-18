<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 10.11.2015 г.
 * Time: 15:37 ч.
 */
$message ='';
?>
<h2><?php echo $heading;?></h2>
<div class="msg error">
    <?php echo validation_errors(); ?>
</div>


            <?php echo form_open('contact/submission');?>
                <table class="contact">
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
                    <tr class="cap">
                        <th><?php echo $image.'<br>'; ?><label class="cap_lb" id="captcha" for="captcha">Enter the text from the picture above</label></th>
                        <td><input class="cap" type="text" name="captcha" maxlength="5" ></td>
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
