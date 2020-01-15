<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return bool whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if (!$user) {
            return false;
        }
        
        if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        }
        $textBody = "<html><body><p>Hi </p><br><br>
                        
                        Please click on the link below link to Reset your password <br>
                        <a style='background: #E2BF6E;
                    color: #000000;
                    height:40px;
                    width:350px;
                    font-weight: 300;
                    font-size: 16px;
                    line-height:40px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    border-radius: 0;
        margin: 30px;' class='email-btn' href='http://174.138.188.236/site/reset-password?token=".$user->password_reset_token."'>Reset password</a>
                        </body></html>";
           return    Yii::$app->mailer->compose()
                    ->setFrom('info@courtsjudgments.com')
                    ->setTo($user->email)
                    ->setSubject('Message subject')
                //    ->setTextBody($textBody)
                    ->setHtmlBody($textBody)
                    ->send();

 /*return Yii::$app->mailer->compose("password-reset", ['member_name'=>'Password Reset','verify_link'=>
                '<a style="background: #E2BF6E;
                    color: #000000;
                    height:40px;
                    width:350px;
                    font-weight: 300;
                    font-size: 16px;
                    line-height:40px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    border-radius: 0;
        margin: 30px;" class="email-btn" href="http://174.138.188.236/site/reset-password?token='.$user->password_reset_token.'">Reset password</a>'
                ])
    ->setFrom('info@courscom.com')
    ->setTo($this->email)
    ->setSubject('Judgement : Password Reset')
    ->send();*/
/*        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();*/
    }
}
