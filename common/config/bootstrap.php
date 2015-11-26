<?php
Yii::setAlias('common', dirname(__DIR__));
Yii::setAlias('frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');

$baseurl='http://localhost/exampeep/';

Yii::setAlias('base_url',  $baseurl);
Yii::setAlias('images_url',  $baseurl.'images');
Yii::setAlias('profile_image',  $baseurl.'upload/');
//Yii::setAlias('images_rating',  $baseurl.'images/raty');
Yii::setAlias('adminupload_url',  $baseurl.'upload/cms_image');
Yii::setAlias('js_url',  $baseurl.'js');
Yii::setAlias('css_url',  $baseurl.'css');