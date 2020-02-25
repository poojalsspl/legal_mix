<?php

namespace frontend\models;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    //public $username;
    public $tnc;
    public $email;
    public $password;
    public $mobile_number;
    public $status;
    public $verifyCode;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

           ['tnc', 'compare', 'compareValue' => true,'message' => 'You must agree to the terms and conditions'],
           ['mobile_number', 'required'],

           ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha'],

           //[[], \himiklab\yii2\recaptcha\ReCaptchaValidator::className(), 'secret' => '6Lcc4G8UAAAAAL-UrX9aUUIssG5bP34ksglstjL3'],

            //['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],

            //['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
    }

    /**
     * Signs user up.
     *

     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->tnc = $this->tnc;
        $user->mobile_number = $this->mobile_number;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;

    }

    public function Userfind($id){

        $user = User::find()->where(['id' => $id])->one();
        //echo $user instanceof User; //returns 1
        //echo $user->username; //checking if empty, returns nothing
        return $user;
    }

    
   

}

