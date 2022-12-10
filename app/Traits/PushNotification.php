<?php


namespace App\Traits;

use OneSignal;


trait PushNotification
{
    public function createPushNotification($event_name, $start_date)
    {
        $userId = config('services.onesignal.authkey');
        $params = [];
        $params['include_player_ids'] = [$userId];
        $contents = [
            "en" => $event_name,
        ];
        $params['contents'] = $contents;
        $params['send_after'] = $start_date;

        $dataOneSignal = \OneSignal::sendNotificationCustom($params);
        $responseOneSignal = $dataOneSignal->getBody();
        $decodedResponse = json_decode($responseOneSignal);

        return $decodedResponse->id;
    }
}
