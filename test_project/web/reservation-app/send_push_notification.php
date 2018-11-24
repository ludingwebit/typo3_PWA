<?php
require __DIR__ . '/vendor/autoload.php';
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

// here I'll get the subscription endpoint in the POST parameters
// but in reality, you'll get this information in your database
// because you already stored it (cf. push_subscription.php)

require_once 'db.php';



/*$sth = mysqli_query($link,"SELECT * FROM be_subscription");
$rows = array();
while($r = mysqli_fetch_assoc($sth)) {
    $rows[] = $r;
}
echo '<pre>'; print_r(json_encode($rows)); echo '</pre>';*/



$sql_query = "SELECT * FROM be_subscription ";
$mysqli_result = mysqli_query($link, $sql_query);
/*$result = json_encode($mysqli_result->fetch_assoc(),JSON_UNESCAPED_SLASHES);*/
$result = $mysqli_result->fetch_assoc();
/*echo '<pre>'; print_r(json_decode($result,true)); echo '</pre>';*/







$subscription = Subscription::create($result);
echo '<pre>'; print_r($subscription); echo '</pre>';

$auth = array(
    'VAPID' => array(
        'subject' => 'https://github.com/Minishlink/web-push-php-example/',
        'publicKey' => 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4',
        'privateKey' => "HJweeF64L35gw5YLECa-K7hwp3LLfcKtpdRNK8C_fPQ" // in the real world, this would be in a secret file
    )
);

$webPush = new WebPush($auth);
$res = $webPush->sendNotification(
    $subscription,
    "Hello!",
    true
);
echo '<pre>'; print_r($res); echo '</pre>';

// handle eventual errors here, and remove the subscription from your server if it is expired
