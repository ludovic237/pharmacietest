<?php

$title_for_layout = ' Admin -'.'Medias';
//$page_for_layout = 'Gallerie';

if($this->request->action == "index"){
    $position = "Tout";
}
else{
    $position = "Présentation";
}
$position_for_layout = '<li><a href="#">Medias</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/jquery/jquery.form.min.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/upload.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/tinymce/tiny_mce.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/tinymce/tiny_mce_popup.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/koudjine/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript">

 document.getElementById(\'links\').onclick = function (event) {
                event = event || window.event;
                var target = event.target || event.srcElement;
                var link = target.src ? target.parentNode : target;
                var options = {index: link, event: event,onclosed: function(){
                        setTimeout(function(){
                            $("body").css("overflow","");
                        },200);
                    }};
                var links = this.getElementsByTagName(\'a\');
                blueimp.Gallery(links, options);
            };


                $(document).ready(function() {




                var options = {
                        target: \'#output\',   // target element(s) to be updated with server response
                        beforeSubmit: beforeSubmit,  // pre-submit callback
                        success: afterSuccess,  // post-submit callback
                        resetForm: true        // reset the form after successful submit
                    };




                 $("#MyUploadForm").submit(function() {

                     $(this).ajaxSubmit(options);
                     // always return false to prevent standard browser submit and page navigation
                     return false;
                 });


                });

            </script>';
?>

<!-- START CONTENT FRAME TOP -->
<div class="content-frame-top">
    <div class="page-title">
        <h2><span class="fa fa-image"></span> Gallery</h2>
    </div>
    <div class="pull-right">
        <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
    </div>
</div>
<!-- START CONTENT FRAME RIGHT -->
<div class="content-frame-right">
    <h4>Upload image:</h4>
    <div class="block push-up-10">
        <div class="alert alert-danger hidden" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <span id="output"></span>
        </div>

        <form id="MyUploadForm" method="post" role="form" class="form-horizontal" enctype="multipart/form-data" action="<?php echo BASE_URL.'/koudjine/inc/uploadmedia.php'; ?>">
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Logo:</label>
                    <div class="col-md-7">
                        <input type="file"  name="image_file" id="imageInput" />
                        <span class="help-block">Sélectionner une image </span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Titre:</label>
                    <div class="col-md-7 ">
                        <input type="text" value=""  name="titre" id="titre" />
                        <span class="help-block">Titre de l'image</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Rubrique:</label>
                    <div class="col-md-9">
                        <select class="select" name="rubrique" id="rubrique"  >
                            <option value="">Choisir Rubrique</option>
                            <option value="universites">Universités</option>
                            <option value="formations">Formations</option>
                            <option value="vie-etudiante">Vie étudiante</option>
                        </select>
                        <span class="help-block">Rubrque dans laquelle vous comptez utiliser ce média</span>
                    </div>
                </div>
                <p>&nbsp;</p>
                <div class="btn center-block">
                    <button class="btn btn-primary" id="submit-btn"  type="submit"><span class="fa fa-upload"></span>Upload</button>
                    <img src="<?php echo BASE_URL.'/koudjine/img/loaders/default.gif'; ?>" id="loading-img" style="display:none;" alt="Please Wait"/>
                </div>
            </div>
        </form>
        <!-- END JQUERY VALIDATION PLUGIN -->
    </div>
    <h4>Groups:</h4>
    <div class="list-group border-bottom push-down-20">
        <a href="<?php echo Router::url('bouwou/medias') ?>" class="list-group-item <?php if(!isset($rubrique) ) { ?>active<?php } ?>">All <span class="badge badge-primary"><?php echo $total1; ?></span></a>
        <a href="<?php echo Router::url('bouwou/medias/index/universites') ?>" class="list-group-item <?php if(isset($rubrique) && $rubrique == 'universites' ) { ?>active<?php } ?>">Universités <span class="badge badge-success"><?php echo $total2; ?></span></a>
        <a href="<?php echo Router::url('bouwou/medias/index/formations') ?>" class="list-group-item <?php if(isset($rubrique) && $rubrique == 'formations' ) { ?>active<?php } ?>">Formations <span class="badge badge-danger"><?php echo $total3; ?></span></a>
        <a href="<?php echo Router::url('bouwou/medias/index/vie-etudiante') ?>" class="list-group-item <?php if(isset($rubrique) && $rubrique == 'vie-etudiante' ) { ?>active<?php } ?>">Vie étudiante <span class="badge badge-info"><?php echo $total4; ?></span></a>
    </div>
</div>
<!-- END CONTENT FRAME RIGHT -->

<!-- START CONTENT FRAME BODY -->
<div class="content-frame-body content-frame-body-left">

<div class="pull-left push-up-10">
    <button class="btn btn-primary" id="gallery-toggle-items">Tout cocher</button>
</div>
<div class="pull-right push-up-10">
    <div class="btn-group">
        <button class="btn btn-primary"><span class="fa fa-trash-o"></span> Delete</button>
    </div>
</div>

<div class="gallery" id="links">
    <?php
        foreach($medias as $k => $v){
            $thumb = str_replace('/','/thumb_',$v->FILE);
            ?>
            <a class="gallery-item" href="<?php echo BASE_URL.'/koudjine/assets/uploads/medias/'.$v->FILE; ?>" onclick="FileBrowserDialogue.sendURL('<?php echo BASE_URL.'/koudjine/assets/uploads/medias/'.$v->FILE; ?>')" title="Nature Image 1" data-gallery>
                <div class="image">
                    <img src="<?php echo BASE_URL.'/koudjine/assets/uploads/medias/'.$thumb; ?>" alt="Nature Image 1" />
                    <ul class="gallery-item-controls">
                        <li><label class="check"><input type="checkbox" class="icheckbox"/></label></li>
                        <li><span class="gallery-item-remove"><i class="fa fa-times"></i></span></li>
                    </ul>
                </div>
                <div class="meta">
                    <strong><?php echo $v->NOM; ?></strong>
                    <span><?php echo $v->RUBRIQUE; ?></span>
                </div>
            </a>
            <?php

        }
    ?>



</div>

<?php

if($pages >= 1 && $this->request->page <= $pages){

    $suivant = $this->request->page + 1 ;
    $precedent = $this->request->page - 1;
    echo "<ul class=\"pagination pagination-sm pull-right\">";
    if($this->request->page != 1){
        if(isset($_GET['type'])){
            $type = $_GET['type'];
            echo "<li class=\"\"><a href=\"?page=".$precedent."&type=".$type."\">«</a></li>";
        }
        else {
            echo "<li class=\"\"><a href=\"?page=".$precedent."\">«</a></li>";
        }
    }
    else {
        echo "<li class=\"disabled\"><a>«</a></li>";
    }
    for ($x=1; $x<=$pages; $x++){
        if(isset($_GET['type'])){
            $type = $_GET['type'];
            echo ($x == $this->request->page) ? '<li class="active"><a href="?page='.$x.'&type='.$type.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'&type='.$type.'">'.$x.'</a></li>';
        }
        else {
            echo ($x == $this->request->page) ? '<li class="active"><a href="?page='.$x.'">'.$x.'</a></li>' : '<li><a href="?page='.$x.'">'.$x.'</a></li>';
        }
    }
    if($this->request->page != $pages){
        if(isset($_GET['type'])){
            $type = $_GET['type'];
            echo "<li class=\"\"><a href=\"?page=".$suivant."&type=".$type."\">»</a></li>";
        }
        else {
            echo "<li class=\"\"><a href=\"?page=".$suivant."\">»</a></li>";
        }
    }
    else {
        echo "<li class=\"disabled\"><a>»</a></li>";
    }
    echo "</ul>";
}
?>
</div>
<!-- END CONTENT FRAME BODY -->
<!-- BLUEIMP GALLERY -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- END BLUEIMP GALLERY -->
<script type="text/javascript" src="<?php echo BASE_URL.'/koudjine/js/plugins/tinymce/tiny_mce_popup.js'; ?>"></script>
<script language="javascript" type="text/javascript">

    var FileBrowserDialogue = {
        init : function () {
            // Here goes your code for setting your custom things onLoad.
        },
        sendURL : function (URL) {
            var win = tinyMCEPopup.getWindowArg("window");

            // insert information now
            win.document.getElementById(tinyMCEPopup.getWindowArg("input")).value = URL;

            // are we an image browser
            if (typeof(win.ImageDialog) != "undefined")
            {
                // we are, so update image dimensions and preview if necessary
                if (win.ImageDialog.getImageData) win.ImageDialog.getImageData();
                if (win.ImageDialog.showPreviewImage) win.ImageDialog.showPreviewImage(URL);
            }

            // close popup window
            tinyMCEPopup.close();
        }
    }

    tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);

</script>
