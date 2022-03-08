<?php
namespace App\Services;

use GuzzleHttp\Client;

class NotificationService{
    function send_notification_FCM($notification_id, $title, $message, $id,$type) {
 
        $accesstoken = env('FCM_KEY');
        $client = new Client([]);//COMENTARIO

        $method = 'POST';
        $requestUrl = "https://fcm.googleapis.com/fcm/send";
        $formParams = [
            "notification" => [
                "body" => "TExto de la notificacion",
                "title" => "Titulo"
            ],
            'priority' => 'high',
            'data' => [
                'data' => 'esta es un data'
            ],
            "registration_ids"=>["cuSM_LxGRfCifKOMfxDy_v:APA91bFDP1b9a8U0OlOevPNHZeMcoy8llJw6e1gl4G5pU2beLXNvRUdyXVZHdazcBMfEE8fYtrIBW6FSEEIyuXITHssz3bnLXTxpaICAcY5hvzrWkN9B-SFY3ntPMbyyZmmxdbLQKaCH"
                ,"dg6g2Fe1QGyh8oag0ZI_9j:APA91bERkV_KfNPG3PpdEn31I4X_UBWtkvHWHH9QfJR_oYqXSwlaxCO1kw9Y2YVF4NQ44VtUCMeHaHKYe7IYalvQnX1z4XIVhpjIJ_oNfZfSs_iMP4y3HDAYeVOegBnOOdRUeqckNZWR",
            "cpMbLNN3QBKNSn_BLDDtpB:APA91bGj59vmvz9UF1a40Dvo_kn8dSBc0GTXbztd6whQ0hsyGepxjX_X2ZaGiF6VsRIpWsouKueqC4YNFZFxMhFJ5VlPF_1V5zvchEP8Q_tdr_SFkx-VzMvNRbMqlHJVtgcfrmMYNdkT"]
        ];
        $headers = [
            'Accept'=> 'application/json',
            'Authorization' => 'key=AAAALvkZHhs:APA91bFUEkcoYwjg6lGsVyjELWNzUuF3OR5gIWaQOtd1rmZa6-p0dsOuzZhDqHytbOLDnBpqfPD-xYYL9LNl3HnnCy2V3Ajlo1CB3M5EOUdtSBDLvpAf8i75gwT9cPnSuCicNBZvZAvl',
            'Content-Type' => 'application/json'
        ];

        $response = $client->request($method, $requestUrl, [
            'json' => $formParams,
            'headers' => $headers
            //'verify' => $this->verifySSL
        ]);

        return $response;
    }
}