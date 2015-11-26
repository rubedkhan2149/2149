<?php

namespace backend\modules\auth;

class Auth extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\auth\controllers';
    public $layout = '@app/modules/auth/views/layouts/main';

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }
}
