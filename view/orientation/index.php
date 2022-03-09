<?php

$title_for_layout = 'Conseil d\'orientation' . ' | Atlant-Front';
$page_for_layout = 'Test d\'orientation';

if ($this->request->action == "index") {
    $position = "Test d'orientation";
} else {
    $position = 'Conseil d\'orientation';
}
$position_for_layout = '<li><a href="#">Conseil d\'orientation</a></li><li class="active">' . $position . '</li>';
$script_for_layout = '<script type="text/javascript" src="' . BASE_URL . '/js/plugins/mixitup/jquery.mixitup.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/js/plugins/appear/jquery.appear.js"></script>
<script type="text/javascript" src="' . BASE_URL . '/js/plugins/knob/jquery.knob.min.js"></script>
    <script type="text/javascript" src="' . BASE_URL . '/js/plugins/owl/owl.carousel.min.js"></script>
    <script type="text/javascript" src="' . BASE_URL . '/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <script type="text/javascript" src="' . BASE_URL . '/js/plugins/scrolltotop/scrolltopcontrol.js"></script>';
?>
<!-- page content holder -->
<div class="page-content-holder">

    <div class="block-heading block-heading-centralized this-animate" data-animate="fadeInDown">
        <div class="text-center">
            <a href="../html/index.html" class="btn btn-default btn-xl faq-title"><span class="fa" style="font-weight: 400;">1</span> Intérêts professionnels</a> <a href="http://themeforest.net/item/atlant-responsive-bootstrap-admin-template/9217590" class="btn btn-default btn-xl faq-title"><span class="fa">2</span> Personnalité</a>
        </div>
    </div>

</div>
<!-- ./page content holder -->
</div>
</div>


<!-- page content wrapper -->
<div class="page-content-wrap bg-light">

    <div class="divider">
        <div class="box"><span class="fa fa-angle-down"></span></div>
    </div>

    <!-- page content holder -->
    <div class="page-content-holder">

        <div class="row">
            <div class="col-md-8 this-animate" data-animate="fadeInLeft">

                <div class="block-heading block-heading-centralized">
                    <h2 class="heading-underline">Pour quels métiers êtes vous fait ?</h2>
                    <div class="block-heading-text">
                        <p>Ce test n'est pas un questionnaire validé scientifiquement. Il se veut simplement un outil pour amorcer votre réflexion sur votre choix de carrière. Si vous voullez aller plus loin, nous vous invitons à consulter un conseiller ou une conseillère d'orientation. </p>
                        <p>De plus, ce site est une ressource supplémentaire qui vous permettra d'avoir des réponses à vos questions et même d'échanger avec une conseillère en orientation. </p>
                        <p>&nbsp;</p>
                        <p><code>Veuillez sélectionner une rubrique ci-dessus pour commencer.</code></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 this-animate text-center" data-animate="fadeInRight">
                <img src="<?php echo BASE_URL . '/img/comprendre-orientation.jpg' ?>" class="img-responsive-mobile" />
            </div>
        </div>