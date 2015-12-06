<div class="msg">
    <?php if ($this->session->flashdata( 'success_signup' )) { ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata( 'success_signup' ); ?>
        </div>
    <?php } ?>
</div>

<?php $attributes = array( 'class' => 'form-signin signup' );
echo form_open( 'login/signup', $attributes ); ?>
<h2 class="form-signin-heading">Creaet new account</h2>
<label for="username">Username:</label>
<input type="text" class="form-control" name="username" maxlength="30" placeholder="Username"
       value="<?php echo set_value( 'username' ); ?>" required="" autofocus=""/>
<label for="email">Email:</label>
<input type="email" class="form-control" name="email" maxlength="30" placeholder="Email Address"
       value="<?php echo set_value( 'email' ); ?>" required="" autofocus=""/>
<label for="password">Password:</label>
<input type="password" class="form-control" name="password" maxlength="20" placeholder="Password"
       value="<?php echo set_value( 'username' ); ?>" required=""/>
<label for="pass">Confirm password:</label>
<input type="password" class="form-control" name="pass" maxlength="20" placeholder="Confirm password" required=""/>
<button class="btn btn-lg btn-primary btn-block" autofocus="" type="submit">Sign Up</button>
<button class="btn btn-lg btn-primary btn-block" type="submit">Cancel</button>
<?php echo form_close(); ?>