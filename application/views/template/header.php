<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
        <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
            <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
                <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>Cuog | Photography Site</title>
                    <meta name="description" content="">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    
                    <link rel="stylesheet" href="<?= base_url() ?>assets/css/normalize.css">
                    <link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.css">
                    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
                    <link rel="stylesheet" href="<?= base_url() ?>assets/css/templatemo-style.css">
                    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
                    <script src="<?= base_url() ?>assets/js/vendor/modernizr-2.6.2.min.js"></script>
        <!-- 
        Masonry Template 
        http://www.templatemo.com/preview/templatemo_434_masonry
    -->
</head>

<body>
    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>

        <div class="content-bg"></div>
        <div class="bg-overlay"></div>
        <!-- SITE TOP -->
        <div class="site-top">
            <div class="site-header clearfix">
                <div class="container">
                    <a href="<?= base_url() ?>" class="site-brand pull-left"><strong>Cuog</strong><br> Photography Site</a>
                    <div class="pull-right">
                            <!-- <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-behance"></a></li>
                            <li><a href="#" class="fa fa-dribbble"></a></li> -->
                            <?php if ($this->session->userdata('status') == 'login') { ?>
                                <div style="color: white;">
                                    <a href="<?= base_url() ?>uploadImage">Upload Image</a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href="<?= base_url() ?>userInfo"><?= $this->session->userdata('username'); ?></a>
                                </div>
                            <?php } else { ?>
                                <div class="social-icons">
                                    <ul>
                                        <li><a href="<?= base_url() ?>login" class="fa fa-user"></a></li>
                                    </ul>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            </div> <!-- .site-header -->
            <!-- <div class="site-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8 text-center">
                            <h2>Get free templates from <span class="blue">template</span><span class="green">mo</span></h2>
                            <p>Masonry is free responsive template that can be used for any website. You may download, modify and use this layout for your personal or commercial websites. Please tell your friends about <span class="blue">template</span><span class="green">mo</span>.com website. Thank you.</p>
                        </div>
                    </div>
                    <div class="row">
                        <form action="#" method="post" class="subscribe-form">
                            <fieldset class="col-md-offset-4 col-md-3 col-sm-8">
                                <input type="email" id="subscribe-email" placeholder="Enter your email...">
                            </fieldset>
                            <fieldset class="col-md-5 col-sm-4">
                                <input type="submit" id="subscribe-submit" class="button white" value="Subscribe!">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> --> <!-- .site-banner -->
        </div> <!-- .site-top -->