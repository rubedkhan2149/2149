<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $ud_password;
    public $rememberMe = false;
    public $role;
    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'ud_password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['ud_password', 'validatePassword'],
        ];
    }
public function attributeLabels()
    {
        return [
            'username' => 'Username or Email',
            'ud_password' => 'Password'
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
       if (!$this->hasErrors()) {
            $user = $this->getUser();
         
            if(!empty($user)){
               $user->password_hash = $user->ud_password;
            }
           if (!$user || !$user->validatePassword($this->ud_password)) {
              $this->addError($attribute, 'Incorrect username or password.');
          }
         
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            Yii::$app->session['role'] = $this->role;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            //$this->_user = User::findByUsername($this->username,$this->role);
            $this->_user = User::find()->byUserNameOrEmail($this->username)->byRole($this->role)->One();
        }
        return $this->_user;
    }
}
