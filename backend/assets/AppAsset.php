<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public function __construct()
    {
        parent::__construct();
        $this->baseUrl=\yii::getAlias('@base_url');
    }


    public $css = [
        'css/bootstrap.css',
        'css/font-awesome.min.css',
        'css/bootstrap-select.css',
        'css/bootstrap-switch.css',
        'css/custom.css',
        
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/bootstrap-select.js',
        'js/bootstrap-switch.js',
    ];
    
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
    
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
