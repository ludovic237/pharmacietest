<div class="page-content-wrap">
    <?php supplement_categorie_universite(); ?>
    <div class="row">
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-body posts">

                    <?php pagination_article(); ?>

                </div>
                <div class="col-md-3">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Categories</h3>
                            <div class="links">
                                <?php list_categorie(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3>Recent</h3>
                            <div class="links small">
                                <?php recent_post(); ?>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>
        <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- ./page content wrapper -->

</div>