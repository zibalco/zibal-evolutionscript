<?php
/**
 *
 * @ EvolutionScript FULL DECODED & NULLED
 *
 * @ Version  : 5.0
 * @ Author   : MTIMER
 * @ Release on : 2014-03-10
 * @ Website  : http://www.mtimer.net
 *
 **/
@session_start();
define("EvolutionScript", 1);
require_once "global.php";
$gateway = $db->fetchRow("SELECT * FROM gateways WHERE id=502");
$m_api = $gateway['account'];

if ($input->p['type'] == "deposit") {
	$upgrade = 0;
	$upgrade_id = 0;
}
else {
	$upgrade = 1;
	$upgrade_id = $db->real_escape_string($_POST['upgradeid']);
}


$_SESSION["upgrades"] = $upgrade;


$_SESSION["upgrade_ids"] = $upgrade_id;



$user_id = $db->real_escape_string($_POST['user']);
$user_info = $db->fetchRow("SELECT * FROM members WHERE id=" . $user_id);

$_SESSION["user_ids"]=$user_id;





//marboote be dargah
$id = $db->lastInsertId();
$_SESSION["ids"]=$id;


$amount = $_POST['amount'];
$_SESSION["amounts"]=$amount;

$callback = "" . $settings['site_url'] . "modules/gateways/zibal_verify.php";
//marboote be dargah







$Mobile ='';

if (is_numeric($upgrade_id)) {
$Description = "پرداخت کاربر " . $user_info['username'] . " برای ارتقا حساب";
}
else {
$Description = "پرداخت کاربر " . $user_info['username'] . " برای شارژ حساب";
}
$result = postToZibal('request',
						array(
								'merchant' 	=> $m_api,
								'amount' 	=> $amount*10,
								'description' 	=> $Description,
								'mobile' 	=> $Mobile,
								'callbackUrl' 	=> $callback
							)
);


if($result->result == 100)
{
Header('Location: https://gateway.zibal.ir/start/'.$result->trackId.'/direct');
} else {
echo'ERR: '.$result->result;
}


/**
 * connects to zibal's rest api
 * @param $path
 * @param $parameters
 * @return stdClass
 */
function postToZibal($path, $parameters)
{
    $url = 'https://gateway.zibal.ir/v1/'.$path;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($parameters));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response  = curl_exec($ch);
    curl_close($ch);
    return json_decode($response);
}
?>
