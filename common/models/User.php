<?php

namespace common\models;

use Yii;
use common\models\base\BaseUser;
use common\models\query\UserQuery;
use yii\helpers\ArrayHelper;

 class User extends BaseUser implements \yii\web\IdentityInterface {
    
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    public $password_hash;
    public $current_password;
    public $confirm_password;
    public $auth_key;

    public static function find()
    {
        return new UserQuery(get_called_class());
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($insert)
            {
                $this->setPassword($this->ud_password);
            }
            return true;
        }

        return false;
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    { 
        return [
            'timestamp' => [
                   'class' => \yii\behaviors\TimestampBehavior::className(),
                   'createdAtAttribute' => 'created_at',
                   'updatedAtAttribute' => 'updated_at',
                   'value' => new \yii\db\Expression('NOW()'),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
         
    
    public function rules() 
    {
        return \yii\helpers\ArrayHelper::merge(
                        parent::rules(), [


        ]);
    }
    
    
    public function changePassword()
    {
        $this->password = $this->setPassword($this->password);
        
        if ($this->save(false)) {
            return true;
        }
    }
    
    public function validateCurrentPasword($attribute, $param)
    {
        $user = self::findOne(['id' => \Yii::$app->user->Id]);
        if($user->password != '') {
            if (!Yii::$app->getSecurity()->validatePassword($this->current_password, $user->password)){
                $this->addError($attribute, 'Your current password is invalid, try again');
            }
        }  else {
            $this->addError($attribute, 'Your current password is invalid, try again');
        }
        
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }


    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        return static::findOne([
            'ud_temp_password' => $token,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.verfyTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->ud_password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
       return $this->ud_password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), 0, 6);
        $this->ud_temp_password = $password;
     
    }
    
    //just to implement
    public static function findIdentityByAccessToken($token, $type = null)
    {
      
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->ud_temp_password = null;
   
    }
    
    public static function findByEmail($email) 
    {
        return static::find()->where(['email' => $email, 'status' => 'active'])->one();
    }
    
    
    public static function getProfileUrl($id)
    {
        $user= self::find()->byUserId($id)->one();
        if(file_exists('/upload/'.$user->userProfile->profile_image))
        {
            return \yii::getAlias('@profile_url').$user->profile_image;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function saveUser($data) {
        $customData=  explode('||', $data['custom']);
        $this->username=trim($customData[0]);
        $this->ud_password=trim($customData[1]);
        $this->email=trim($customData[2]);
        $this->save();
        return $this;
    }
}
