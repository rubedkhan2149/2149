<?php
namespace frontend\models;
use Yii;
use common\models\User;
use yii\base\Model;
use common\models\UserUtility;
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
     public function rules() {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'checkExist',
//                'targetClass' => '\common\models\User',
//                'filter' => ['status'=>['active','inactive']],
//                'message' => 'There is no user with  this email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function attributeLabels() {
        return [
            'email' => 'Email'
        ];
    }
    public function sendEmail()
    {
        /* @var $user User */
        $user = \common\models\User::findOne([
                    'status' => ['active','inactive'],
                    'email' => $this->email,
        ]);
       // \yii\helpers\VarDumper::dump($user);
      //  die;
        $data = array();
        $user->generatePasswordResetToken();
        $userProfile = \common\models\UserProfile::findOne(['user_id' => $user->id]);
        if ($user->user_type=='admin')
        {
            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/login/reset-password','token' => $user->ud_temp_password]);
            $data['user'] = $userProfile->first_name.' '.$userProfile->last_name;
        }
        else
        {
            $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['auth/login/reset-password', 'token' => $user->ud_temp_password]);
            $data['user'] = $userProfile->first_name.' '.$userProfile->last_name;
        }
        if ($user->save(false))
        {
            $resetLink =$resetLink; 
            $data['to'] = $user->email;
            $data['link'] = $resetLink;
            $data['request'] = "forget_password";
            Utility::sendMail($data);
            return true;
        }
        return false;
    }
    
    public function checkExist() 
    {
        $user = User::find()->where(['email' => $this->email, 'status' => ['active','inactive']])->one();
        if(!empty($user)) 
        {
            if($user->status == 'inactive') 
            {
                $this->addError('email', 'Your account is inactive.');
            }
        } 
        else 
        {
            $this->addError('email', 'There is no user with this email.');
        }
    }
}
