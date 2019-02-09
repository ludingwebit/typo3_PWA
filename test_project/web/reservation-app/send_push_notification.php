<?php
require __DIR__ . '/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use WebitDe\AcmeReservation\Domain\Model\Subscriber;
// here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)
require_once 'db.php';
$auth = array(
    'GCM' => 'AIzaSyDh_ESvfgG2l7C3UYE5dJtoaO5dxAfbxu0', // deprecated and optional, it's here only for compatibility reasons
    'VAPID' => array(
        'subject' => 'Restaurant-Webit-TYPO3',
        'publicKey' => 'BN6lqWVgCzcsA17voiRXUHKXSprhR3MktTvk9d1exjWFY5Vdu6Pr5WN0dMhhsG6C0IxHmhurmUrhTcr7o0hJ_oE',
        'privateKey' => "aVqT-nwU_UYH5CienWj0pqm8N3FwwtrtfKum44TnUtk", // in the real world, this would be in a secret file
    )
);
$query_mysql = mysqli_query($link,"SELECT * FROM tx_acmereservation_domain_model_subscriber ");
$subscribers = array();
$webPush = new WebPush($auth);
$notification = json_encode([
            "icon" => "https://cdn0.iconfinder.com/data/icons/linkedin-ui-colored/48/JD-12-512.png",
            "title" => "This is only a Test for Push-Notifications",
            "tag" => "SymfonyPushNotification",
            "body" => "I hope you can forgive us for disturbing you!",
            "url" => "https://mediadesign-luding.de"
        ]);
//Informationen aus Datenbank holen
while($r = mysqli_fetch_assoc($query_mysql)) {
    $subscribers[] = $r;
}
//für jeden Eintrag eine Sendung durchführen
foreach($subscribers as $subscriber){
            $arr = array('endpoint'=>$subscriber['endpoint'], $notification, 'publicKey'=>$subscriber['browser_key'],'authToken' => $subscriber['auth_secret']);
            $subscriber = Subscription::create($arr);
            $webPush->sendNotification($subscriber, false);
            print_r("I've sent a notification!");
        }
        $responses = $webPush->flush();
        foreach($responses as $response){
            switch ($response["success"]){
                case false:
                        print_r($response["message"]);
                    break;
                case true:
                    /// no need to bother the user with success ones
                    break;
            }
        }


//echo '<pre>'; print_r($subscription); echo '</pre>';

//$res = $webPush->sendNotification(
//    $subscription,
//    "Hello!",
//    true
//);
//echo '<pre>'; print_r($res); echo '</pre>';

// handle eventual errors here, and remove the subscription from your server if it is expired
