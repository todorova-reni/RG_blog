<div class="msg">
    <?php if ($this->session->flashdata( 'success_verification' )) { ?>
        <div class="alert alert-success">
            <?php echo $this->session->flashdata( 'success_verification' ); ?>
        </div>
    <?php }
    if ($this->session->flashdata( 'error_verification' )) { ?>
        <div class="alert alert-warning">
            <?php echo $this->session->flashdata( 'error_verification' ); ?>
        </div>
    <?php }
    if ($this->session->flashdata( 'error_login' )) { ?>
        <div class="alert alert-warning">
            <?php echo $this->session->flashdata( 'error_login' ); ?>
        </div>
    <?php }?>
</div>

<?php $attributes = array( 'class' => 'form-signin' );
echo form_open( 'login/login_user', $attributes ); ?>
<h2 class="form-signin-heading">Please login</h2>
<input type="text" class="form-control" name="username" maxlength="30" placeholder="Username" required="" autofocus=""/>
<input type="password" class="form-control" name="password" maxlength="20" placeholder="Password" required=""/>
<label class="checkbox" for="remember">
    <input type="checkbox" value="remember-me" id="remember" name="remember"> Remember me
</label>
<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
<?php echo anchor( 'login/signup/', 'Create account' ); ?>
<?php echo form_close(); ?>
