<?php
namespace common\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;
    public $confirm_password;
    private $_user;

    public function __construct($token, $config = [])
    {       
        if (empty($token) || !is_string($token))
        {
            throw new InvalidParamException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        
        if (!$this->_user)
        {
            //throw new InvalidParamException('Wrong password reset token.');
            throw new \yii\web\BadRequestHttpException('Password reset link is expired or invalid.');           
        }
        parent::__construct($config);        
    }

    public function rules(){
        return [
            [['password','confirm_password'], 'required'],
            [['password'], 'string', 'length' => [6, 16]],
            [['confirm_password'], 'compare', 'compareAttribute'=>'password', 'message'=>'Passwords do not match','operator'=>'==', 'skipOnEmpty'=>false],
        ];
    }

    public function resetPassword(){        
        $user = $this->_user;        
        $user->password = $user->setPassword($_POST['ResetPasswordForm']['password']);;
        $user->ud_temp_password = null;        
        return $user->save(false);
    }
    
    public function setPassword($password)
    {   
        return $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
