<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use frontend\assets\NewTheme;
use common\widgets\Alert;
use yii\widgets\Breadcrumbs;

NewTheme::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?php $this->registerCsrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
<!-- circle on image -->
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/pages-style.css" rel="stylesheet" type="text/css"/>
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/style_registration_form.css" rel="stylesheet" type="text/css"/>

<!-- company name -->
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/style.css" rel="stylesheet" type="text/css"/>
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/demo.css" rel="stylesheet" type="text/css"/>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--main image size increases, hide features section-->
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/custom.css" rel="stylesheet" type="text/css"/>
<!--header section-->
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/css-65c5c-92080.min.css" rel="stylesheet" type="text/css"/>
<!--Registration Form, Footer-->
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/css-7c69b-92082.css" rel="stylesheet" type="text/css"/>
<link href="<?= Yii::$app->params['domainName'] ?>css/css_new/jquery.fancybox.min.css" rel="stylesheet" type="text/css"/>
</head>
<body class="sticky-header">
<?php $this->beginBody() ?>

<div id="main-container">
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
      <li class="active"> <a href="<?= Yii::$app->params['domainName'] ?>site/index">HOME</a></li>
      <li> <a href="<?= Yii::$app->params['domainName'] ?>site/about">ABOUT US</a></li>
             <!--<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">User <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Change Password</a></li>
            <li><a href="#">Subscription</a></li>
          </ul>
        </li>-->
        <li> <a href="<?= Yii::$app->params['domainName'] ?>site/contact">CONTACT US</a></li>
        <li><a href="<?= Yii::$app->params['domainName'] ?>site/login">LOGIN</a></li>
         <li><a href="<?= Yii::$app->params['domainName'] ?>site/signup">SIGNUP</a></li>
      </ul>
    </div>
  </div>
</nav>

    <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        
        	<!-- FOOTER -->
	<footer id="footer-container">

		<div id="footer">

			<div class="container">
				<div class="row">
					<div class="col-md-4">
                      <h4><span>Contact Us</span></h4>
                      <div>
                      	Laxyo House, County Park,<br>
                        Plot No. 2, MR-5,<br>
                        Mahalaxmi Nagar, Indore,<br>
                        Madhya Pradesh 452010
                      </div>
		            </div><!-- col-md-4 -->
					<div class="col-md-4">
                      <h4><span>Services Links</span></h4>
                      <div>
                      	Home<br>
                      	About Us<br>
                      	Contact Us<br>
                      	Login<br>
                      	Signup
                      </div>
		            </div><!-- col-md-4 -->
		            <div class="col-md-4">
		            <h4><span>Twitter Feed</span></h4>
		            <div>
		            	Court Judgement<br>
                        Monday, 06 February 2012 03:10<br><br>
                        Court Judgement<br>
                        Monday, 06 February 2012 03:10
		            </div>
		            </div>
				</div><!-- row -->
				<div class="row">
				
              <div class="col-md-12">

                <p class="copyright"><small>&copy; All rights reserved</small></p>

              </div>

            
            </div><!-- row -->
			</div><!-- container -->
			

		</div><!-- footer -->


	</footer><!-- FOOTER -->
</div>
<?php $this->endBody() ?>	
</body>
</html>
<?php $this->endPage() ?>
