<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\InnerPage;
use common\widgets\Alert;
InnerPage::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <!--<meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <style type="text/stylesheet">
            @-webkit-viewport   { width: device-width; }
            @-moz-viewport      { width: device-width; }
            @-ms-viewport       { width: device-width; }
            @-o-viewport        { width: device-width; }
            @viewport           { width: device-width; }
        </style>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
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
      <?php if (!Yii::$app->user->isGuest){ ?>
          <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">User <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li><a href="<?= Yii::$app->params['domainName'] ?>site/dashboard">Profile</a></li>
          <li><a href="<?= Yii::$app->params['domainName'] ?>site/planform">Subscription</a></li>
          <li><a href="<?= Yii::$app->params['domainName'] ?>site/change-password">Change Password</a></li>
          <li> <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post']]) ?></li>
          </ul>
        </li>

<?php 
} else { ?>
        <li><a href="<?= Yii::$app->params['domainName'] ?>site/login">LOGIN</a></li>
         <li><a href="<?= Yii::$app->params['domainName'] ?>site/signup">SIGNUP</a></li>
<?php
}
?>
</ul>
</div>
</div>
</nav>
<!-- TOPBAR -->
  
    
        <?php Breadcrumbs::widget([
  
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