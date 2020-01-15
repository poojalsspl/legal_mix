<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use frontend\assets\CJAsset;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;

CJAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
         <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-65c5c-92080.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-7c69b-92082.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-a1381-92078.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <link href="http://fonts.googleapis.com/css?family=Playfair+Display|Poppins:400,600,700" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-42c1d-92080.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <script src="<?= Yii::$app->params['domainName'] ?>/t3-assets/js/js-9a8dd-92082.js" type="text/javascript"></script>
        <script src="<?= Yii::$app->params['domainName'] ?>/t3-assets/js/js-ca15c-92080.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css"  crossorigin="anonymous">
        <script src="http://allyoucan.cloud/cdn/jquery/core/3.3.1/jquery.js"  crossorigin="anonymous"></script>
        <link rel="stylesheet" href="http://allyoucan.cloud/cdn/jquery/ui/1.12.1/jquery-ui.theme.css"  crossorigin="anonymous">

        <link href="index.html" rel="alternate" hreflang="x-default" />
        <!-- META FOR IOS & HANDHELD -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <style type="text/stylesheet">
            @-webkit-viewport   { width: device-width; }
            @-moz-viewport      { width: device-width; }
            @-ms-viewport       { width: device-width; }
            @-o-viewport        { width: device-width; }
            @viewport           { width: device-width; }
        </style>
        <script type="text/javascript">
            //<![CDATA[
            if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement("style");
                msViewportStyle.appendChild(
                    document.createTextNode("@-ms-viewport{width:auto!important}")
                );
                document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
            }
            //]]>
        </script>
        <meta name="HandheldFriendly" content="true"/>
        <meta name="apple-mobile-web-app-capable" content="YES"/>
        <!-- //META FOR IOS & HANDHELD -->
        <!-- Le HTML5 shim and media query for IE8 support -->
        <!--[if lt IE 9]>
        <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script type="text/javascript" src="/plugins/system/t3/base-bs3/js/respond.min.js"></script>
        <![endif]-->
        <!-- You can add Google Analytics here or use T3 Injection feature -->
    </head>
<body>
<?php $this->beginBody() ?>
<div class ="t3-wrapper"> <!-- Need this wrapper for off-canvas menu. Remove if you don't use of-canvas -->
<!-- TOPBAR -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"><img src="<?= Yii::$app->params['domainName'] ?>images/logo4.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
 
      <ul class="nav navbar-nav navbar-right">
      <li class="active"> <a href="<?= Yii::$app->params['domainName'] ?>">HOME</a></li>
    
        <li> <a href="<?= Yii::$app->params['domainName'] ?>site/contact">CONTACT US</a></li>
        <li> <a href="https://www.cms.courtsjudgments.com/news/">NEWS</a></li>
        <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="https://www.cms.courtsjudgments.com/faq/">FAQ<span class="caret"></span></a>
        
          <ul class="dropdown-menu">
          <li><a href="https://www.cms.courtsjudgments.com/faq-sub/">Faq-sub</a></li>
          
          </ul>
        </li>
        <li> <a href="https://www.cms.courtsjudgments.com/law-article/">LAW ARTICLE</a></li>

        <li><a href="<?= Yii::$app->params['domainName'] ?>site/login">LOGIN</a></li>
         <li><a href="<?= Yii::$app->params['domainName'] ?>site/signup">SIGNUP</a></li>
      </ul>
    </div>
  </div>
</nav>
<!-- TOPBAR -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
</div>
    <!-- FOOTER -->
        

<footer id="t3-footer" class="wrap t3-footer">
    <!-- FOOT NAVIGATION -->
    <div class="container">
        <!-- SPOTLIGHT -->
        <div class="t3-spotlight t3-footnav  row">
            <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="t3-module module " id="Mod119"><div class="module-inner"><h3 class="module-title "><span>Contact Us</span></h3><div class="module-ct">
                <div class="section-inner">
                    <div class="acm-contact style-1" id="acm-contact-119">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="contact-item">
                                        <h3 class="contact-name">Indore</h3>
                                        <ul class="contact-list">
                                            <li>Laxyo House, County Park,</li>
                                            <li>Plot No. 2, MR-5,</li>
                                            <li>Mahalaxmi Nagar, Indore,</li>
                                            <li>Madhya Pradesh 452010</li>
                                        </ul>
                                    </div>
                                </div>
                          
                       
                            </div>
                     
                        </div>
               

                    </div>

                </div></div></div></div>

            </div>

            <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="t3-module module" id="Mod117"><div class="module-inner"><h3 class="module-title "><span>Services Links</span></h3><div class="module-ct"><ul class="nav nav-pills nav-stacked menu">

                <li class="item-116"><a href="https://www.cms.courtsjudgments.com/about-us/" class="">About US</a></li><li class="item-104 divider parent"><a href="https://www.cms.courtsjudgments.com/terms-of-usage/"><span class="separator ">Terms of Usage</span></a>

                </li><li class="item-120"><a href="https://www.cms.courtsjudgments.com/privacy-policy/" class="">Privacy Policy</a></li><li class="item-121"><a href="https://www.cms.courtsjudgments.com/payment-policy/" class="">Payment Policy</a></li>
                <li class="item-122"><a href="https://www.cms.courtsjudgments.com/eula/" class="">EULA</a></li>
                <li class="item-123"><a href="https://www.cms.courtsjudgments.com/sla/" class="">SLA</a></li>
                </ul>

            </div></div></div>

        </div>

                  <div class=" col-lg-4 col-md-4 col-sm-6 col-xs-12">

            <div class="t3-module module " id="Mod116"><div class="module-inner"><h3 class="module-title "><span>Features</span></h3><div class="module-ct"><ul class="nav nav-pills nav-stacked menu">

                <li class="item-101"><a href="https://www.cms.courtsjudgments.com/crm/" class="">Lawyers CRM</a></li><li class="item-116"><a href="https://www.cms.courtsjudgments.com/case-diary/" class="">Lawyers Case Diary</a></li><li class="item-104 divider parent"><a href="https://www.cms.courtsjudgments.com/brief-case/"><span class="separator ">Document Mnagement System</span></a>

                </li><li class="item-120"><a href="https://www.cms.courtsjudgments.com/pricing-plans/" class="">Flexible Pricing Plan</a></li>
                <li class="item-121"><a href="https://www.cms.courtsjudgments.com/search-features/" class="">High-End Database Search</a></li>
                <li class="item-122"><a href="https://www.cms.courtsjudgments.com/lawyers-directory-appointment/" class="">Lawyers Directory & Appointment</a></li>
               
                </ul>

         
           </div></div></div>

            </div>
                        <!--<div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <div class="t3-module module " id="Mod115"><div class="module-inner"><h3 class="module-title "><span>Social Links</span></h3><div class="module-ct">

    </div></div></div><div class="t3-module module " id="Mod122"><div class="module-inner"><div class="module-ct">

    <div class="custom"  >

        <ul class="social-list">

            <li><a href="#" title="Facebook" class="facebook"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>

            <li><a href="#" title="Twitter" class="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
            

            <li><a href="#" title="YouTube" class="youtube"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>


            

        </ul></div>

    </div></div></div>

</div>-->




</div>

<!-- SPOTLIGHT -->

</div><hr width="85%">

<!-- //FOOT NAVIGATION -->

<section class="t3-copyright text-center">

<div class="container">



<div class="copyright">

    <div class="module">

        <small>Copyright. All Rights Reserved.

    </div>

</div>

</div>

</section>

</footer>

<!-- //FOOTER -->

</div>



<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>