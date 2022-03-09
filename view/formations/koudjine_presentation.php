<?php

$title_for_layout = ' ALSAS -' . 'Universités';
$page_for_layout = 'Présentation de la formation';

if($this->request->action == "index"){
    $position = "Facultés";
}
else{
    $position = "Présentation";
}
$position_for_layout = '<li><a href="#">Universites</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery/jquery.form.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/functions.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/wysiwyg.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript">


                $(document).ready(function() {

                var sel= $(\'#presentation_formation option:selected\').val();
                if(sel ==\'\') $(\'#submit-btn\').addClass(\'disabled\');


                var options = {
                        target: \'#output\',   // target element(s) to be updated with server response
                        beforeSubmit: beforeSubmit,  // pre-submit callback
                        success: afterSuccess,  // post-submit callback
                        resetForm: true        // reset the form after successful submit
                    };




                 $("#MyUploadForm").submit(function() {
                    tinyMCE.triggerSave();
                     $(this).ajaxSubmit(options);
                     // always return false to prevent standard browser submit and page navigation
                     return false;
                 });


                });

            </script>';
?>


<div class="row">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="form-group" id="ville">
                <label class="col-md-3 col-xs-12 control-label">Sélectionner une formation</label>
                <div class="col-md-6 col-xs-12">
                    <select class="form-control select" name="srch_formation" id="presentation_formation">
                        <option></option>
                        <?php
                        foreach ($formations as $k => $v): ?>
                            <option <?php if(!empty($formation)) if($v->SLUG == $formation->SLUG) echo "selected=\"selected\""; ?> value="<?php echo $v->SLUG; ?>" ><?php echo $v->SLUG; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
<div class="col-md-10">

<!-- START JQUERY VALIDATION PLUGIN -->
<div class="block">
    <div class="alert alert-danger hidden" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <span id="output"></span>
    </div>

<form id="MyUploadForm" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" action="<?php echo BASE_URL.'/koudjine/inc/presentation_formation.php'; ?>">
<div class="panel-body">
    <div class="form-group">
        <label class="col-md-3 control-label hidden">Logo:</label>

        <div class="col-md-2 ">
            <input type="hidden" value="<?php if(!empty($formation)) echo $formation->SLUG; ?>"  name="slug" id="slug" />
        </div>
    </div>
    <div class="form-group" style="height: 300px;">
        <label class="col-md-3 control-label">Page de présentation :</label>
        <div class="col-md-9">
            <textarea  class="form-control wysiwyg" name="editable"  id="editable"><?php if(!empty($presentation)) echo $presentation->CONTENU; ?></textarea>
            <span class="help-block">Cette partie sert à décrire comment va se présenter la page d'accueil de l'université</span>
        </div>
    </div>
<p>&nbsp;</p>
<div class="btn pull-right">
    <button class="btn btn-primary" id="submit-btn"  type="submit">Enregistrer</button>
    <img src="<?php echo BASE_URL.'/koudjine/img/loaders/default.gif'; ?>" id="loading-img" style="display:none;" alt="Please Wait"/>
</div>
</div>
</form>
<!-- END JQUERY VALIDATION PLUGIN -->
</div>

</div>

</div>