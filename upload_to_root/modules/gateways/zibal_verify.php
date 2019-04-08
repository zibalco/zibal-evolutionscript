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



//marboot be dargah
$m_api = $gateway['account'];
$id = $_SESSION["ids"];
$amount = $_SESSION["amounts"]; 
$au = $_SESSION["aus"];
//marboot be dargah


$order_id = $_SESSION["user_ids"];
$upgrade = $_SESSION["$upgrades"];
$upgrade_id = $_SESSION["upgrade_ids"];
$today = TIMENOW;



$Authority = $_GET['trackId'];
$batch = $Authority;



if($_GET['success'] == '1'){

$result = postToZibal('verify',
						  	array(
									'merchant'	 => $m_api,
									'trackId' 	 => $Authority,
								)
		);



if($result->result == 100){
        if($result->amount!=$amount*10)
            die("amount invalid");
		$customer = $result->refId;


		if (is_numeric($upgrade_id)) {
	        include GATEWAYS . "process_upgrade.php";
	        header("location:" . $settings['site_url'] . "index.php?view=account&page=thankyou&type=upgrade");
                exit();
		}
		
                else {		
		include GATEWAYS . "process_deposit.php";
	        header("location:" . $settings['site_url'] . "index.php?view=account&page=thankyou&type=funds");
                exit();
                }
}

else {

if (is_numeric($upgrade_id)) {
header("location:" . $settings['site_url'] . "index.php?view=account&page=upgrade");
exit();} 

else  {
header("location: " . $settings['site_url'] . "index.php?view=account&page=addfunds");
exit();}

}

}




else {

if (is_numeric($upgrade_id)) {
header("location:" . $settings['site_url'] . "index.php?view=account&page=upgrade");
exit();} 

else  {
header("location: " . $settings['site_url'] . "index.php?view=account&page=addfunds");
exit();}

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
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
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