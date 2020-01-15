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
        <title>Courts Judgements</title>
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-65c5c-92080.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-7c69b-92082.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-a1381-92078.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <link href="http://fonts.googleapis.com/css?family=Playfair+Display|Poppins:400,600,700" rel="stylesheet" type="text/css" />
        <link href="<?= Yii::$app->params['domainName'] ?>/t3-assets/css/css-42c1d-92080.css" rel="stylesheet" type="text/css" media="all" attribs="[]" />
        <script src="<?= Yii::$app->params['domainName'] ?>/t3-assets/js/js-9a8dd-92082.js" type="text/javascript"></script>
        <script src="<?= Yii::$app->params['domainName'] ?>/media/system/js/cored691.js?v=1513092074" type="text/javascript"></script>
        <script src="<?= Yii::$app->params['domainName'] ?>/media/com_acymailing/js/acymailing_moduled756.js?v=580" type="text/javascript" async="async"></script>
        <script src="<?= Yii::$app->params['domainName'] ?>/t3-assets/js/js-ca15c-92080.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" integrity="sha384-DmABxgPhJN5jlTwituIyzIUk6oqyzf3+XuP7q3VfcWA2unxgim7OSSZKKf0KSsnh" crossorigin="anonymous">
        <script src="http://allyoucan.cloud/cdn/jquery/core/3.3.1/jquery.js" integrity="sha384-tCxhoyRWDdt53xP+AAKzIVwvee+PjO1JfnV06WrDzG2B3cyeewQGjZNaxGbgJwlT" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="http://allyoucan.cloud/cdn/jquery/ui/1.12.1/jquery-ui.theme.css" integrity="sha384-pRi5Zt/xoe6Jv8MBdTZpU7MixYccsC+XAg41fVs8+wHUPrwsEVrKrzSLDwR2EX29" crossorigin="anonymous">
        <script type="text/javascript">
        jQuery(window).on('load',  function() {
                    new JCaption('img.caption');
                });
        jQuery(function($){ $(".hasTooltip").tooltip({"html": true,"container": "body"}); });
        if(typeof acymailing == 'undefined'){
                        var acymailing = Array();
                    }
                    acymailing['NAMECAPTION'] = 'Name';
                    acymailing['NAME_MISSING'] = 'Please enter your name';
                    acymailing['EMAILCAPTION'] = 'E-mail';
                    acymailing['VALID_EMAIL'] = 'Please enter a valid e-mail address';
                    acymailing['ACCEPT_TERMS'] = 'Please check the Terms and Conditions';
                    acymailing['CAPTCHA_MISSING'] = 'The captcha is invalid, please try again';
                    acymailing['NO_LIST_SELECTED'] = 'Please select the lists you want to subscribe to';


        jQuery(function($) {
                $('.hasTip').each(function() {
                    var title = $(this).attr('title');
                    if (title) {
                        var parts = title.split('::', 2);
                        var mtelement = document.id(this);
                        mtelement.store('tip:title', parts[0]);
                       mtelement.store('tip:text', parts[1]);
                    }
                });
                var JTooltips = new Tips($('.hasTip').get(), {"maxTitleChars": 50,"fixed": false});
            });
        </script>
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
      <a class="navbar-brand" href="#"><img src="images/logo4.png"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
 
      <ul class="nav navbar-nav navbar-right">
      <li class="active"> <a href="<?= Yii::$app->params['domainName'] ?>/site/index">HOME</a></li>
      <li> <a href="<?= Yii::$app->params['domainName'] ?>site/about">ABOUT US</a></li>
             <!--<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">User <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="#">Subscription</a></li>
          </ul>
        </li>-->
        <li> <a href="<?= Yii::$app->params['domainName'] ?>/index.php?r=site/contact">CONTACT US</a></li>
        <li><a href="<?= Yii::$app->params['domainName'] ?>/index.php?r=site/login">LOGIN</a></li>
         <li><a href="<?= Yii::$app->params['domainName'] ?>/index.php?r=site/signup">SIGNUP</a></li>
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
            <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="t3-module module " id="Mod119"><div class="module-inner"><h3 class="module-title "><span>Contact Us</span></h3><div class="module-ct">
                <div class="section-inner">
                    <div class="acm-contact style-1" id="acm-contact-119">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="contact-item">
                                        <h3 class="contact-name">London</h3>
                                        <ul class="contact-list">
                                            <li><i class="icofont icofont-social-google-map"></i>25th, Park Vista, London</li>
                                            <li><i class="icofont icofont-iphone"></i>+00 987 654 3210</li>
                                            <li><i class="icofont icofont-mail"></i>londoninfo@joomlart.com</li>
                                            <li><i class="icofont icofont-clock-time"></i>Mon to Sat: 9:0 to 18:00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="contact-item">
                                        <h3 class="contact-name">New York</h3>
                                        <ul class="contact-list">
                                            <li><i class="icofont icofont-social-google-map"></i>10 St Joseph's Gardens, Carlisle CA1 2UQ</li>
                                            <li><i class="icofont icofont-iphone"></i>+33 000 000 2304</li>
                                            <li><i class="icofont icofont-mail"></i>newyorkinfo@joomlart.com</li>
                                            <li><i class="icofont icofont-clock-time"></i>Mon to Sat: 8:0 to 19:00</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="contact-item">
                                        <h3 class="contact-name">Canberra</h3>
                                        <ul class="contact-list">
                                            <li><i class="icofont icofont-social-google-map"></i>Goyder Street, Narrabundah, 2604 Canberra, Australia</li>
                                            <li><i class="icofont icofont-iphone"></i>+01 929 040 2485</li>
                                            <li><i class="icofont icofont-mail"></i>canberrainfo@joomlart.com</li>
                                            <li><i class="icofont icofont-clock-time"></i>Mon to Sat: 8:30 to 17:00</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Add Pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                        <script>
                        var swiper = new Swiper('#acm-contact-119 .swiper-container', {

                                pagination: '#acm-contact-119 .swiper-pagination',

                        paginationClickable: true,

                                    

                        spaceBetween: 30

                        });

                        </script>

                    </div>

                </div></div></div></div>

            </div>

            <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <div class="t3-module module " id="Mod117"><div class="module-inner"><h3 class="module-title "><span>Services Links</span></h3><div class="module-ct"><ul class="nav nav-pills nav-stacked menu">

                <li class="item-101 default current active parent"><a href="index.html" class="">Home</a></li><li class="item-116"><a href="blog.html" class="">Blog</a></li><li class="item-104 divider parent"><span class="separator ">Pages</span>

                </li><li class="item-120"><a href="news.html" class="">News</a></li><li class="item-121"><a href="contact-us.html" class="">Contact Us</a></li></ul>

            </div></div></div>

        </div>

        <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">

            <div class="t3-module module " id="Mod116"><div class="module-inner"><h3 class="module-title "><span>Twitter Feed</span></h3><div class="module-ct"><div class="ja-twitter">

            

            <!-- ACCOUNT INFOMATION -->

            <!-- // ACCOUNT INFOMATION -->

            

            <!-- LISTING TWEETS -->

            

            <div class="ja-twitter-tweets">

                

                <div class="ja-twitter-item">

                    

                    

                    <div class="ja-twitter-text">

                        

                        Court Judgement

                        </div>

                        <div class="ja-twitter-date" style="">

                        Monday, 06 February 2012 03:10          </div>

                    </div>

                    <div class="ja-twitter-item">

                        

                        

                        <div class="ja-twitter-text">

                            

                            Court Judgement</div>

                            <div class="ja-twitter-date" style="">

                            Monday, 06 February 2012 03:10          </div>

                        </div>

                    </div>

                    

                    <!-- //LISTING TWEETS -->

                    

                    <!-- LISTING FRIENDS -->

                    <!-- //LISTING FRIENDS -->

                </div></div></div></div>

            </div>

            <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <div class="t3-module module " id="Mod115"><div class="module-inner"><h3 class="module-title "><span>Subscribe Us</span></h3><div class="module-ct"><div class="acymailing_module" id="acymailing_module_formAcymailing78441">

                <div class="acymailing_fulldiv" id="acymailing_fulldiv_formAcymailing78441"  >

                    <form id="formAcymailing78441" action="https://ja-lawfirm.demo.joomlart.com/index.php/en/" onsubmit="return submitacymailingform('optin','formAcymailing78441', 0)" method="post" name="formAcymailing78441"  >

                        <div class="acymailing_module_form" >

                            <div class="acymailing_introtext">Subscribe to our Newletter to get first Gift voucher by StartLorem Ipsum.</div>           <table class="acymailing_form">

                            <tr>

                                <td class="acyfield_email acy_requiredField">

                                    <input id="user_email_formAcymailing78441"  onfocus="if(this.value == 'E-mail') this.value = '';" onblur="if(this.value=='') this.value='E-mail';" class="inputbox" type="text" name="user[email]" style="width:100%" value="E-mail" title="E-mail"/>

                                </td>

                                

                                <td  class="acysubbuttons">

                                    <button class="button subbutton btn btn-primary" type="submit" name="Submit" onclick="try{ return submitacymailingform('optin','formAcymailing78441', 0); }catch(err){alert('The form could not be submitted '+err);return false;}">

                                    <i class='icofont icofont-paper-plane'></i>                     </button>

                                </td>

                            </tr>

                        </table>

                        <input type="hidden" name="ajax" value="0" />

                        <input type="hidden" name="acy_source" value="module_115" />

                        <input type="hidden" name="ctrl" value="sub"/>

                        <input type="hidden" name="task" value="notask"/>

                        <input type="hidden" name="redirect" value="https%3A%2F%2Fja-lawfirm.demo.joomlart.com%2Findex.php%2Fen%2F"/>

                        <input type="hidden" name="redirectunsub" value="https%3A%2F%2Fja-lawfirm.demo.joomlart.com%2Findex.php%2Fen%2F"/>

                        <input type="hidden" name="option" value="com_acymailing"/>

                        <input type="hidden" name="hiddenlists" value="1"/>

                        <input type="hidden" name="acyformname" value="formAcymailing78441" />

                    </div>

                </form>

            </div>

        </div>

    </div></div></div><div class="t3-module module " id="Mod122"><div class="module-inner"><div class="module-ct">

    <div class="custom"  >

        <ul class="social-list">

            <li><a href="#" title="Facebook" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

            <li><a href="#" title="Twitter" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>

            <li><a href="#" title="Instagram" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>

            <li><a href="#" title="Google plus" class="google-plus"><i class="fa fa-google" aria-hidden="true"></i></a></li>

        </ul></div>

    </div></div></div>

</div>

</div>

<!-- SPOTLIGHT -->

</div>

<!-- //FOOT NAVIGATION -->

<section class="t3-copyright text-center">

<div class="container">



<div class="copyright">

    <div class="module">

        <small>Copyright &#169; 2018. All Rights Reserved.

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