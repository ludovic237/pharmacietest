<form action="<?php echo Router::url('users/login'); ?>" class="form-horizontal" method="post">
    <div>
        <div style="padding-bottom: 10px;border-bottom-style: solid;border-bottom-width: 1px;border-bottom-color: #8c8c8c80;">
            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" id="inputbarecode" name="barecode" value="" class="form-control" placeholder="Code barre">
                </div>
            </div>
            <select class="form-control question selectpicker" name="question" id="ort_question">
                <option value="0">Caissier</option>
                <option value="1">Administrateur</option>
                <option value="2">Pharmacien</option>
            </select>
        </div>
        <div style="padding-top: 10px;padding-bottom: 20px;">
            <?php echo $this->Form->input('username', 'Identifiant', 'text'); ?>
            <?php echo $this->Form->input('password', 'Mot de Passe', 'password'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6">
            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
        </div>
        <div class="col-md-6">
            <button class="btn btn-info btn-block">Log In</button>
        </div>
    </div>
</form>