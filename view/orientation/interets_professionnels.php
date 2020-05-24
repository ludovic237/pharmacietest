<?php

$title_for_layout = 'Conseil d\'orientation'.' | Atlant-Front';
$page_for_layout = 'Test d\'orientation';

if($this->request->action == "index"){
    $position = "Test d'orientation";
}else{
    $position = 'Conseil d\'orientation';
}
$position_for_layout = '<li><a href="#">Conseil d\'orientation</a></li><li class="active">'.$position.'</li>';
$script_for_layout = '
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/setting/plugins.js"></script>
<script type="text/javascript" src="'.BASE_URL.'/js/plugins/appear/jquery.appear.js"></script>
    <script type="text/javascript" src="'.BASE_URL.'/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>
<!-- page content holder -->
<div class="page-content-holder">

    <div class="block-heading block-heading-centralized this-animate" data-animate="fadeInDown">
        <div class="text-center">
            <a href="<?php echo BASE_URL.'/orientation/interets_professionnels';?>" class="btn btn-primary btn-xl faq-title"><span class="fa" style="font-weight: 400;">1</span> Intérêts professionnels</a> <a href="<?php echo BASE_URL.'/orientation/personnalite';?>" class="btn btn-default btn-xl faq-title"><span class="fa">2</span> Personnalité</a>
        </div>
    </div>

</div>
<!-- ./page content holder -->
</div>
</div>


<!-- page content wrapper -->
<div class="page-content-wrap bg-light">

    <div class="divider"><div class="box"><span class="fa fa-angle-down"></span></div></div>

    <!-- page content holder -->
    <div class="page-content-holder">

        <div class="row">
            <div class="col-md-12 this-animate" data-animate="fadeInLeft">

                <div class="block-heading">
                    <?php
                    $i = 1;
                    foreach($questions as $k => $v){
                        ?>
                        <div class="question quote this-animate" data-animate="fadeInDown" style="background: #FFFFFF;">
                            <div class="form-group col-md-7" style="">
                                <label class=""><span><?php echo $i; ?>- </span><?php echo $v->QUESTION; ?></label>
                            </div>
                            <div class="form-group col-md-5" style="">
                                <div class="form-group col-md-4">
                                    <input type="radio" class="iradio col-md-12" id="<?php echo $v->QUESTION_ID.'_1'; ?>" name="iradio<?php echo $i; ?>"/>
                                    <label class="col-md-12">Pas du tout</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="radio" class="iradio col-md-12" id="<?php echo $v->QUESTION_ID.'_2'; ?>" name="iradio<?php echo $i; ?>"/>
                                    <label class="col-md-12">Moyennement</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="radio" class="iradio col-md-12" id="<?php echo $v->QUESTION_ID.'_3'; ?>" name="iradio<?php echo $i; ?>"/>
                                    <label class="col-md-12">Beaucoup</label>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    }
                    ?>
                    <div class="block-heading this-animate block-heading-centralized" data-animate="fadeInLeft">
                        <button  class="btn btn-primary btn-xl">Valider</button>
                    </div>

                </div>
            </div>
        </div>