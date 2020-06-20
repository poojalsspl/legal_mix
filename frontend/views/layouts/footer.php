<?php
    use yii\helpers\Html;
?>
<footer class="main-footer-alt footer-alt theme-color-main-footer col-md-12">
     <section class="footer-section theme-color-main-footer">
        <div class=" row align-center theme-color-main-footer">
            <div class="col-md-3 col-xs-12">
                <h4 class="footer-title">CONTACT US</h4>

                <div class="footer-block footer-column">
                    <ul class="footer-column-1">
                        <li>Laxyo House, County Park,</li>
                        <li>Plot No. 2, MR-5,</li>
                        <li>Mahalaxmi Nagar, Indore,</li>
                        <li>Madhya Pradesh 452010</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <h4 class="footer-title">SERVICE LINKS</h4>
                
                <div class="footer-block footer-column">
                    <ul class="footer-column-2">
                        <li><?=Html::a('About Us','/legal_mix/site/about', ['class' =>  ''])?></li>

                        <li><?=Html::a('Terms of Usage', '/legal_mix/articles/view/4', ['class' =>  ''])?></li>
                        <li><?=Html::a('Privacy Policy', '/legal_mix/articles/view/5', ['class' =>  ''])?></li>
                        <li><?=Html::a('EULA', '/legal_mix/articles/view/7', ['class' =>  ''])?></li>
                       
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <h4 class="footer-title">FEATURES</h4>

                <div class="footer-block footer-column">
                    <ul class="footer-column-2">
                        <li><?=Html::a('Advance Search','/legal_mix/articles/view/9', ['class' =>  ''])?></li>
                        <li><?=Html::a('Text base search in search', '/legal_mix/articles/view/10', ['class' =>  ''])?></li>
                        <li><?=Html::a('Indian Bareacts', '/legal_mix/articles/view/11', ['class' =>  ''])?></li>
                        <li><?=Html::a('Legal Document', '/legal_mix/articles/view/12', ['class' =>  ''])?></li>
                        
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <h4 class="footer-title-last">FOLLOW US</h4>

                <div class="footer-block footer-column">
                    <ul class="footer-column-4">
                        <li><?=Html::a('<span class="footer-social-icon"><i class="fa fa-facebook-square"></i></span>','https://www.facebook.com/courts.judgments.3', ['class' =>  ''])?></li>
                        <li><?=Html::a('<span class="footer-social-icon"><i class="fa fa-youtube-square"></i></span>','https://www.youtube.com/channel/UCzrzbY6HYUK8sCVu8K6x1LA', ['class' =>  ''])?></li>
                        <li><?=Html::a('<span class="footer-social-icon"><i class="fa fa-twitter-square"></i></span>','https://twitter.com/CJudgments', ['class' =>  ''])?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
     </section>
     <section class="footer-bottom">
         <div class="row">
             <div class="col-md-8 col-md-offset-2 text-center copyright-text">

                 &copy; 2020 Courts Judgments | Designed & Developed By <a href="http://libersolution.com/">  &nbsp;Liber Solutions Pvt.  Ltd.  &nbsp;&nbsp;</a>  |&nbsp;&nbsp;  Server by <a href="http://www.sipl.net/">  &nbsp;Scorpio Informatics Pvt.  Ltd.</a> 
             </div>
         </div>
     </section>

</footer>