<!--<div class="hero-unit">
    <h1>Page introuvable</h1>
    <p><?php echo $message; ?></p>
</div>-->
<?php $position_for_layout = '<li class="active">Error 404</li>'; ?>
<div class="row">
    <div class="col-md-12">

        <div class="error-container">
            <div class="error-code">404</div>
            <div class="error-text">page not found</div>
            <div class="error-subtext">Unfortunately we're having trouble loading the page you are looking for. Please wait a moment and try again or use action below.</div>
            <div class="error-actions">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info btn-block btn-lg" onClick="document.location.href = '<?php echo BASE_URL.''; ?>';">Retour à l'accueil</button>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary btn-block btn-lg" onClick="history.back();">Page précédente</button>
                    </div>
                </div>
            </div>
            <div class="error-subtext">Or you can use search to find anything you need.</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <input type="text" placeholder="Search..." class="form-control"/>
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><span class="fa fa-search"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>