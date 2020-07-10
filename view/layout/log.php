<!DOCTYPE html>
<html lang="en" class="body-full-height">
<head>
    <!-- META SECTION -->
    <title>Atlant - Responsive Bootstrap Admin Template</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->
    <link rel="icon" href="<?php echo BASE_URL.'/koudjine/favicon.ico'; ?>" type="image/x-icon" />

    <!-- CSS INCLUDE -->
    <link rel="stylesheet" type="text/css" id="theme" href="<?php echo BASE_URL.'/koudjine/css/theme-default.css'; ?>"/>
    <!-- EOF CSS INCLUDE -->
    <script>
        window.onload = function () {
            document.getElementById("inputbarecode").focus();
        };
    </script>
</head>
<body>

<div class="login-container lightmode">

    <div class="login-box animated fadeInDown">
        <div class="login-logo"></div>
        <div class="login-body">
            <div class="login-title"><strong>Log In</strong> to your account</div>
            <?php echo $content_for_layout; ?>
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2014 AppName
            </div>
            <div class="pull-right">
                <a href="#">About</a> |
                <a href="#">Privacy</a> |
                <a href="#">Contact Us</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>