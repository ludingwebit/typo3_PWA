<?php
use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
// Check composer autolader
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    die('Dependency error. Can\'t access vendor folder. Please run »composer install« first.');
} else {
    require __DIR__ . '/vendor/autoload.php';
}

/*header('Content-Type: application/json');*/

require_once 'db.php';
/*$return_arr = array();
$sql = "SELECT id, name, status FROM be_reservierung";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["name"]. " " . $row["status"]. "<br>";
        array_push($return_arr, $row);
    }
} else {
    echo "0 results";
}
echo $return_arr;*/


$return_arr = array();

$fetch = mysqli_query($link,"SELECT id,name, datum, zeit, email, anzahl , status FROM be_reservierung");

while ($row = mysqli_fetch_array($fetch, MYSQLI_ASSOC)) {
    $row_array['id'] = $row['id'];
    $row_array['name'] = $row['name'];
    $row_array['datum'] = $row['datum'];
    $row_array['zeit'] = $row['zeit'];
    $row_array['email'] = $row['email'];
    $row_array['anzahl'] = $row['anzahl'];
    $row_array['status'] = $row['status'];

    array_push($return_arr,$row_array);
/*    if ($row['status'] == "Genehmigt"){
        $auth = array(
            'VAPID' => array(
                'subject' => 'https://github.com/Minishlink/web-push-php-example/',
                'publicKey' => 'BCmti7ScwxxVAlB7WAyxoOXtV7J8vVCXwEDIFXjKvD-ma-yJx_eHJLdADyyzzTKRGb395bSAtxlh4wuDycO3Ih4',
                'privateKey' => 'HJweeF64L35gw5YLECa-K7hwp3LLfcKtpdRNK8C_fPQ', // in the real world, this would be in a secret file
            ),
        );

        $webPush = new WebPush($auth);

        $res = $webPush->sendNotification(
            $subscription,
            "Hello!",
            true
        );
    }
    else{
        echo  "Mach einfach weiter es hat sich nichts geändert.";
    }*/
}



echo json_encode($return_arr);

/*$confirmation = [
    'message' => 'Success',
];*/

/*if($data['userid'] === '0815') {
    $confirmation['message'] = 'Error';
}*/

/*echo json_encode($confirmation);*/
