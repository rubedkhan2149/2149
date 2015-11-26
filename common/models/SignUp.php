<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class SignUp extends Model
{
    public $username;
    public $ud_password;
    public $email;
    public $first_name;
    public $last_name;
    public $address_line1;
    public $country_id;
    public $state_id;
    public $city;
    public $zipcode;
    public $edu_level;
    public $upcoming_exam;
    public $rememberMe = true;
    public $role;
    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'ud_password'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 10],
            [['first_name'], 'string', 'max' => 20],
            [['last_name'], 'string', 'max' => 30],
            [['edu_level', 'upcoming_exam'], 'string'],
            [['country_id', 'state_id'], 'integer'],
            [['address_line1'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 100],
            [['zipcode'], 'string', 'max' => 50],
            [['username','ud_password','email','first_name','last_name','edu_level','upcoming_exam','country_id','state_id','address_line1','city','zipcode'], 'required','on'=>'free'],
            [['username','ud_password','email'], 'required','on'=>'community'],
            ['email', 'emailexist']
        ];
    }
    
    public function emailexist() {

        $user=  User::findOne(['email'=>  $this->email,'status'=>'active']);

            if (empty($user)) {
                return true;
            } else {
                $this->addError('email', 'Email Already Exist');
                return false;
            }
        
    }
public function attributeLabels()
    {
        return [
          
            'username' => 'Username',
            'email' => 'Email',
            'ud_password' => 'Password',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'edu_level' => 'Edu Level',
            'upcoming_exam' => 'Upcoming Exam',
            'country_id' => 'Country ID',
            'address_line1' => 'Address Line1',
            'state_id' => 'State ID',
            'city' => 'City',
            'zipcode' => 'Zipcode'
   
        ];
    }
    
    public function registerFreeMember() {
        $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();

            try
            {
                
                $user = $this->saveUser();
                $this->saveUserProfile($user);
                $this->saveUserAddress($user);
                
                if ($this->hasErrors(NULL)) {
                    throw new \Exception;
                }

                $valid = true;
                $transaction->commit();
                return array('success'=> true,'data'=>  $this);
            }
            catch (\Exception $e)
            {
                if (YII_DEBUG)
                {
                    $this->addError('misc', $e->getMessage());
                }
                else
                {
                    $this->addError('misc', 'Failed to register, please try again later.');
                }
                $transaction->rollBack();
                return array('success'=> false, 'error' => $e->getMessage());
            }
    }
    
    
    public function saveUser() 
    {
        $model = new User();
        $model->attributes = $this->attributes;
      
        if ($model->validate())
        {
           
            $model->save();
            $this->_user = $model;
        }
        else
        {
            foreach ($model->errors as $key => $value) {
                    $this->addError($key, $model->getFirstError($key));
                }
        }

        return $model;
    }
    
    public function saveUserProfile($user) 
    {
        $model = new UserProfile();
        $model->attributes = $this->attributes;
        $model->user_id = $user->id;
       
        if ($model->validate())
        {
            $model->save();
        }
        else
        {
            foreach ($model->errors as $key => $value) 
            {
                $this->addError($key, $model->getFirstError($key));
            }
        }
        return $model;
    }
    
    public function saveUserAddress($user) 
    {
        $model = new UserAddress();
        $model->attributes = $this->attributes;
        $model->user_id = $user->id;
        if ($model->validate())
        {
            $model->save();
        }
        else
        {
            foreach ($model->errors as $key => $value) {
                    $this->addError($key, $model->getFirstError($key));
                }
        }
        return $model;
    }
}
