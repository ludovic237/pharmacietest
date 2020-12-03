<!DOCTYPE html>
<html lang="en" class="body-full-height">

<head>
    <!-- META SECTION -->
    <title>ALSAS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    <link rel="icon" href="<?php echo BASE_URL . '/koudjine/favicon.ico'; ?>" type="image/x-icon" />

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo BASE_URL . '/koudjine/css/theme-default.css'; ?>" />
    <!-- EOF CSS INCLUDE -->
    <script>
        window.onload = function() {
            document.getElementById("inputbarecode").focus();
        };
    </script>
</head>

<body>

    <div class="login-container lightmode">

        <div class="login-box animated fadeInDown">
            <!-- <div class="login-logo"> ALSAS</div> -->
            <div style="padding: 20px;color: white;font-size: 20px;background-color: #b64645;text-align: center;align-content: center;align-items: center;justify-content: center;display: flex;"> ALSAS</div>
            <div class="login-body" style="position: relative;display: flex;flex-direction: column;width: 100%;pointer-events: auto;background-color: #fff;background-clip: padding-box;border: 1px solid rgba(0,0,0,0.2);border-radius: .3rem;outline: 0;">
                <h4 style=" text-align:center; margin-bottom: 1.5rem;font-size: 1.5rem;margin-top: .5rem !important;font-weight: normal;">
                    <div style="    opacity: .6">Bienvenue,</div>
                    <span style="font-size: 1.1rem;">Veuillez vous connecter à votre compte.</span>
                </h4>
                <?php echo $content_for_layout; ?>
            </div>
            <div class="login-footer">
                <div class="pull-left">
                    &copy; 2020
                </div>
                <div class="pull-right">
                    <!-- <a href="#">About</a> |
                <a href="#">Privacy</a> |
                <a href="#">Contact Us</a> -->
                </div>
            </div>
        </div>

    </div>

</body>

</html>