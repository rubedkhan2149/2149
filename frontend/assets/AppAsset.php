<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;
/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
   public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
     
          'css/bootstrap.css',
          'css/animate.css',
         'css/font-awesome.min.css',
        'css/bootstrap-select.css',
        'css/jquery.mCustomScrollbar.css',
        'css/custom.css',       
        
        
        ];
    public $js = [
        
        'js/jquery.min.js', 
        'js/bootstrap.min.js', 
        'js/wow.min.js',
        'js/jquery.sticky.js',
         'js/enscroll-0.6.1.min.js', 
        'js/bootstrap-select.js', 
         'js/jquery.mCustomScrollbar.concat.min.js', 
        'js/jquery.smartmenus.min.js', 
         'js/jquery.smartmenus.bootstrap.min.js', 
    ];
    
     public $jsOptions = array(
        'position' => View::POS_HEAD
    );
    
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
