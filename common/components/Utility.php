<?php

namespace common\components;

use Yii;
use yii\web\Response;
use common\models\EmailTemplate;

class Utility {

    public static $request;
    public static $response;
    public static $user;
    public static $url;
    public static $getFlashMsg;

    public static function getCurrentDate($format = "Y-m-d H:i:s") {
        return date($format);
    }

    public static function setFlashMessage($key, $message) {
        return \Yii::$app->getSession()->setFlash($key, self::getMsgParam($message));
    }

    public static function getFlashMessage($key) {
        return \Yii::$app->getSession()->getFlash($key);
    }

    public static function hasFlashMessage($key) {
        return \Yii::$app->getSession()->getFlash($key);
    }

    public static function sendMail($data)
    {
        $from = Utility::getConfig('admin_email');
        $url= parse_url(\yii::$app->urlManager->getHostInfo());
        $search=[
                '{copyright}' => '&copy; '.date('Y').' - '.\yii::$app->urlManager->getHostInfo().' All rights reserved.',
                '{logo}'      => \yii::getAlias('@base_url').'/images/logo.jpg',
                '{domain_name}' => $url['host'],
                '{domain_url}'  => \yii::$app->urlManager->getHostInfo()
            ];
        
        
        switch ($data['request'])
        {

            case "forget_password":
                $subject = "Reset Password Link";
                $to = $data['to'];
                $link = $data['link'];
                $emailModel = EmailTemplate::getEmailTemplate('forget_password');
                $emailContent = $emailModel->content;
                $search['{name}']=  ucwords($data['user']);
                $search['{link}']=  $data['link'];
                $emailContent = str_replace(array_keys($search),  array_values($search) ,$emailContent);
                break;
            case "user_registration":
                $subject = "Registration";
                $to = $data['to'];
                $link = $data['activationLink'];
                $emailModel = EmailTemplate::getEmailTemplate('user_registration');
                $emailContent = $emailModel->content;
                $emailContent = str_replace('{name}', ucwords($data['user_name']), $emailContent);
                $emailContent = str_replace('{link}', $data['activationLink'], $emailContent);
                break;
            
            case "newsletter":

                $subject = $data['subject'];
                $to = $data['email'];
                $emailModel = EmailTemplate::getEmailTemplate('news_letter');
                $emailContent = $emailModel->et_content;
                $emailContent = str_replace('{name}', $to, $emailContent);
                $emailContent = str_replace('{message}', $data['message'], $emailContent);

                break;
             
            default:
                echo "default case";
        }
        \Yii::$app->mail->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($emailContent)
                ->send();
        return true;
    }

    public static function getMsgParam($key) {
        return \yii::$app->params['Message'][$key];
    }

    public static function getParam($key) {
        return Yii::$app->params[$key];
    }

    public static function getRequest() {
        return self::$request = \yii::$app->request;
    }

    public static function getResponse() {
        return self::$response = \yii::$app->response;
    }

    public static function getUser() {
        return self::$user = Yii::$app->user;
    }

    public static function getUrl($key) {
        return Yii::$app->urlManager->createUrl($key);
    }

    public static function makeSlug($model, $name) {
        $name = trim($name);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $name));
        $data = $model->findAll(['u_slug' => $slug]);
        if (empty($data))
            return strtolower($slug);
        else
            return strtolower($slug . '-' . rand(11, 99));
    }

    public static function getLimitedString($string, $limit) {
        //strip tags to avoid breaking any html
        $mainString = strip_tags($string);
        if (strlen($mainString) > $limit) {
            //truncate string
            $stringCut = substr($mainString, 0, $limit);
            // make sure it ends in a word so assassinate doesn't become ass...
            $finalString = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
            return $finalString;
        } else {
            return $string;
        }
    }

    public static function getConfig($key) {
        $model = \Yii::$app->db->createCommand("SELECT value FROM setting where name='{$key}'");
        $value = $model->queryColumn();
        if (!empty($value))
            return $value[0];
        else
            return null;
    }

    public static function showName($fname, $lname = "") {
        if ($lname == "")
            return ucwords($fname);
        else
            return ucwords($fname . " " . $lname);
    }

    public static function renderJSON($data) {
        header('Content-type: application/json');
        echo json_encode($data);
        die;
    }

    public static function changeImageName($fileName) {
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $uniqueName = uniqid() . "-" . time();
        $newName = str_replace($fileName, $uniqueName, $fileName) . "." . $ext;
        return $newName;
    }

    public static function changeDateFormatToDMY($date) {
//        $newDate = date('M "-" DD "-" y')
        $newDate = date(' d M y', strtotime($date));
        return $newDate;
    }

    public static function getThumbImageSize($sourceImageWidth, $sourceImageHeight, $thumbMaxWidth, $thumbMaxHieght) {
//        define('THUMBNAIL_IMAGE_MAX_WIDTH', 700);
//        define('THUMBNAIL_IMAGE_MAX_HEIGHT', 700);
        $sourceAspectRatio = $sourceImageWidth / $sourceImageHeight;
        $thumbnailAspectRatio = $thumbMaxWidth / $thumbMaxHieght;
        if ($sourceImageWidth <= $thumbMaxWidth && $sourceImageHeight <= $thumbMaxHieght) {
            $thumbnailImageWidth = $sourceImageWidth;
            $thumbnailImageHeight = $sourceImageHeight;
        } elseif ($thumbnailAspectRatio > $sourceAspectRatio) {
            $thumbnailImageWidth = (int) ($thumbMaxHieght * $sourceAspectRatio);
            $thumbnailImageHeight = $thumbMaxHieght;
        } else {
            $thumbnailImageWidth = $thumbMaxWidth;
            $thumbnailImageHeight = (int) ($thumbMaxWidth / $sourceAspectRatio);
        }
        return ['width' => $thumbnailImageWidth, 'height' => $thumbnailImageHeight];
    }

    public static function unlinkFile($path, $file) {
        $path . $file;
        if (file_exists($path . $file)) {
            unlink($path . $file);
            return true;
        } else {
            return false;
        }
    }

    public static function generateAccessToken() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomStr = substr(str_shuffle($characters), 0, 5);
        $accessToken = time() . $randomStr;
        return $accessToken;
    }

//    public static function make_slug($title) {
//        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $title));
//        return $slug;
//    }
    public static function make_slug($name, $id) {               
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $name));
        $data = \common\models\Offers::findAll(['slug' => $slug]);
        if (empty($data)) {
            return strtolower($slug);
        } else {
            return strtolower($slug . '-' . $id);
        }
    }

    public static function getlatitudeLongitude($zipcode) {
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $zipcode . "&sensor=false";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
        if ($response['status'] != 'OK') {
            return null;
        }
        $latLng = $response['results'][0]['geometry']['location'];

        return $latLng;
    }

   public static function calculate_time_span($date) {
        $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($date);
        $months = floor($seconds / (3600 * 24 * 30));
        $day = floor($seconds / (3600 * 24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);

        if ($seconds < 60)
            $time = $secs . " secs ago";
        else if ($seconds < 60 * 60) {
            $time = $mins . " min ago"; 
            if($mins > 1) {
                $time = $mins . " mins ago"; 
            }
        }
        else if ($seconds < 24 * 60 * 60) {
            $time = $hours . " hour ago"; 
            if($hours > 1) {
                  $time = $hours . " hours ago"; 
            }
        }
        else if ($day > cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'))) {
            $time = $months . " month ago";
            if($months > 1) {
                 $time = $months . " months ago";
            }
        }  
        else {
            $time = $day . " day ago";
            if($day > 1) {
               $time = $day . " days ago"; 
            }
            
        }
         

        return $time;
    }

    public static function getUserIdByUsername($usename) {
        $model = new \common\models\User();
        $userId = $model->findIdByUsername($usename);
        if(!empty($userId)) {
              return $userId->id;
        } else {
            return '';
        }
      
    }
    public static function getPostedOfferCount($userId)
    {
        $sql = "SELECT count(*)AS posted_offers FROM `offers` where dateframe >=CURDATE() AND user_id = {$userId} AND status = 'active'";
        $result = \Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
        
        
    }
    public static function getAppliedOfferCount($userId)
    {
        $appledOfferData = \common\models\OfferApplied::findAppliedOffersByAttr(['user_id'=>$userId,'status'=>'active']);
        $idsArray = [];
        foreach ($appledOfferData as $offerData) {
            $idsArray[]= $offerData->offer_id;
        }
        $currentDate = date('Y-m-d');
        $result = \common\models\Offers::find()
                ->select('offers.*')
                ->where(['offers.id' => $idsArray,'offers.status'=>'active'])
                ->leftJoin('user_profile','user_profile.user_id = offers.user_id')
                ->andWhere('dateframe >= :currentDate', ['currentDate' => $currentDate])
                ->andWhere(['offers.status'=>'active','user_profile.status'=>['active']])
                ->all();        
        return count($result);  
    }
    public static function getRecentMessageCount($userId)
    {
        $sql = "SELECT count(*) 
                FROM `message` m 
                JOIN message_recipient mr 
                ON m.id = mr.message_id
                where mr.to_user_id = {$userId} 
                AND mr.read_status='unread'";
        $result = \Yii::$app->db->createCommand($sql)->queryScalar();
        return $result;
    }
    public static function getIsAvailableForStateJob($userId)
    {
        $userProfile = \common\models\UserProfile::findUserByAttr(['user_id'=>$userId]);
        if((!empty($userProfile)) && (!empty($userProfile->available_for_stat_job)) && $userProfile->available_for_stat_job == 'yes') {
            return 1;
        } else {
            return 0;
        }
    }
    
    public static function getRandomCode()
    {
        $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $su = strlen($an) - 1;
        return substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1) .
                substr($an, rand(0, $su), 1);
    }

}
