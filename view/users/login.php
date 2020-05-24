<form action="<?php echo Router::url('users/login'); ?>" class="form-horizontal" method="post">
    <?php echo $this->Form->input('username','Identifiant','text'); ?>
    <?php echo $this->Form->input('password','Mot de Passe','password'); ?>
    <div class="form-group">
        <div class="col-md-6">
            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
        </div>
        <div class="col-md-6">
            <button class="btn btn-info btn-block">Log In</button>
        </div>
    </div>
</form>