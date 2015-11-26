<?php
namespace common\models;

use common\models\UserDetail;
use common\models\Property;
use common\models\EmailTemplate;
use common\models\CmsPage;
use yii\db\ActiveRecord;
use Yii;

class UserUtility {

     public static function make_slug($model, $name) {
        $name=trim($name);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $name));
        $data = $model->findAll([$model->prefix.'_slug' => $slug]);
        if (empty($data))
            return strtolower($slug);
        else
            return strtolower($slug . '-' . rand(11, 99));
    }
     public static function createThumb($source, $destination, $img, $thumbWidth, $thumbHeight) {
        $imgData = getimagesize($source . '/' . $img);

        $sType = $imgData['mime'];
        $sWidth = $imgData[0];
        $sHeight = $imgData[1];

        switch ($sType) {
            case 'image/gif':
                $simg = imagecreatefromgif($source . '/' . $img);
                break;

            case 'image/jpg': case 'image/jpeg':
                $simg = imagecreatefromjpeg($source . '/' . $img);

                break;
            case 'image/png':
                $simg = imagecreatefrompng($source . '/' . $img);
                break;
        }
        $dimg = imagecreatetruecolor($thumbWidth, $thumbHeight);
     
        imagecopyresampled($dimg, $simg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $sWidth, $sHeight);

        switch ($sType) {
            case 'image/gif':
                imagegif($dimg, $destination . '/' . $img);
                break;

            case 'image/jpg': case 'image/jpeg':
                imagejpeg($dimg, $destination . '/' . $img);

                break;
            case 'image/png':
                imagepng($dimg, $destination . '/' . $img);
                break;
        }

        imagedestroy($dimg);
        imagedestroy($simg);
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

    public static function FormatDate($date) {
        //return April 24, 2014;
        if(!empty($date))
            return $today = date("d-m-Y", strtotime($date));
        else
            return '-';
    }
    
     public static function MessageFormatDate($date) {
         //return April 24 ;
         if(!empty($date))
            return  $today = date("F j", strtotime($date));
         else
             return '';
     }
    
    


    public static function getImage($path = "", $filename = "") 
    {
       $baseUrl = Yii::getAlias('@base_url');
       $imagePath = str_replace($baseUrl,"", $path);
       $imagePath = substr($imagePath, 1);
       $str='';
       if(Yii::$app->id)
       {
            $str="../../frontend/web/";    
       }
       if(!empty($filename) && file_exists($str.$imagePath.'/'.$filename))
        {
            $puImg = $baseUrl.'/'.$imagePath.'/'.$filename;           
             return $puImg;
        } else
        {
            $puImg = Yii::getAlias('@images_url').'/'.'default.jpg';
            return $puImg;
        }
    }
    
       public static function pagination($dataProvider) {
        
       return \yii\widgets\LinkPager::widget([
			  
			'pagination'=>$dataProvider->pagination,
			'maxButtonCount'=>10,
                        'firstPageLabel'=>'First',
                         'lastPageLabel'=>'Last',

			'options'=>['class'=>'pagination pull-right' ,'id'=>'propertyPager'],
                     
		  ]);
           
      } 
      
       // Last message title show dots  

            
    public static function sendMail($data)
   {
  
        $subject = "Reset Password Link";
        $to =  $data['to'];
        $from =  Yii::$app->params['supportEmail'];
        
           \Yii::$app->mailer->compose()
               ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($data['link'])
                ->send();
           return true;
   }
            
            
           
   public static function getaddress($lat, $lng) {
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($lat) . ',' . trim($lng) . '&sensor=false';
        $json = @file_get_contents($url);
        $data = json_decode($json);
        $status = $data->status;
        if ($status == "OK")
            return $data->results[0]->formatted_address;
        else
            return 'error';
    }          
  
          
}
