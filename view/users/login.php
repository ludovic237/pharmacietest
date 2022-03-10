<form action="<?php echo Router::url('users/login'); ?>" class="form-horizontal" method="post">
    <div>
        <div style="padding-bottom: 10px;border-bottom-style: solid;border-bottom-width: 1px;border-bottom-color: #8c8c8c80;">
            <?php echo $this->Form->input('barecode', 'Code barre', 'password'); ?>
            <?php echo $this->Form->select('statut', array('Vendeur'=>'1','Caissier'=>'2')); ?>
        </div>
        <div style="padding-top: 10px;padding-bottom: 20px;">
            <?php echo $this->Form->input('username', 'Identifiant', 'text'); ?>
            <?php echo $this->Form->input('password', 'Mot de Passe', 'password'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <!-- <a href="#" class="btn btn-link btn-block">Forgot your password?</a> -->
        </div>
        <div class="col-md-6">
            <button class="btn btn-info btn-block">Connexion</button>
        </div>
    </div>
</form>