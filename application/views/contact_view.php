<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 10.11.2015 г.
 * Time: 15:37 ч.
 */
$message = '';
?>

<div class="contact col-md-12">
    <h2 class="page-header">Contact us</h2>

    <div class="msg error">
        <?php echo validation_errors(); ?>
    </div>

    <?php echo form_open( 'contact/submission' ); ?>
    <table class="table custom">
        <tr>
            <th><label for="name">Name: </label></th>
            <td><input type="text" name="name" id="name" maxlength="30" autofocus="" required
                       value="<?php echo set_value( 'name' ); ?>" placeholder="Your name here..."></td>
        </tr>
        <tr>
            <th><label for="tel">Phone: </label></th>
            <td><input type="tel" name="tel" id="tel" size="10" required value="<?php echo set_value( 'tel' ); ?>"
                       placeholder="Your phone number..."></td>
        </tr>
        <tr>
            <th><label for="email">Email: </label></th>
            <td><input type="email" name="email" id="email" maxlength="30" required
                       value="<?php echo set_value( 'email' ); ?>" placeholder="Your Email address..."></td>
        </tr>
        <tr>
            <th><label for="mssg">Message: </label></th>
            <td><textarea name="mssg" id="mssg" placeholder="Type your message here..."
                          required><?php echo set_value( 'mssg' ); ?></textarea></td>
        </tr>
        <tr>
            <th><label class="cap_lb" id="captcha" for="captcha"><?php echo $image . '<br>'; ?></label></th>
            <td><input class="cap" type="text" name="captcha" maxlength="5" placeholder="Text from the image here...">
            </td>
        </tr>
        <tr>
            <th></th>
            <td><input class="button" type="submit" value="Send">
                <input class="button" type="reset" value="Cancel">
            </td>
        </tr>
    </table>

    <?php echo form_close(); ?>
</div>

<!-- <div class="list">

                <?php foreach ($rows as $row) { ?>
                    <p>№:&#32;<?php echo $row->id; ?></p>
                    <p>Name:&#32;<?php echo $row->name; ?></p>
                    <p>Tel:&#32;<?php echo $row->phone; ?></p>
                    <p>Email:&#32;<?php echo $row->email; ?></p>
                    <p>Message:&#32;<?php echo $row->message; ?></p>
                    <hr />
                <?php } ?>
           </div>-->
