<?php

$data = array(
            'secret' => "0xB88308E594DdCF79Bb24A7EEf83CC723DDFd3853",
            'response' => $_POST['h-captcha-response']
        );

$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
// var_dump($response);
$responseData = json_decode($response);

if($responseData->success) {
	$datapseudo = array(
            'username' => "MyEcoria",
	        'password' => "Antoine@120707.",
	        'recipient' => $_POST['pseudo'],
	        'amount' => "0.001",
	        'memo' => "MyEcoria Faucet"
        );
	curl_setopt($verify, CURLOPT_URL, "https://server.duinocoin.com/transaction/");
	curl_setopt($verify, CURLOPT_POST, true);
	curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($datapseudo));
	curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
	$responseduino = curl_exec($verify);
	// var_dump($response);


}
 
else {
   // return error to user; they did not pass
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>MyEcoria | Faucet</title>
	<link rel="stylesheet" type="text/css" href="css/faucet.css">
	<script src="https://js.hcaptcha.com/1/api.js" async defer></script>
</head>
<body>
	<div class="faucet">
		<h1 class="titre">MyEcoria Faucet <img src="logo/logo.png" height="45px"></h1>
		<br>
		<form action="" method="POST">
		  <label for="fname">Pseudo DuinoCoin:</label><br>
		  <input type="text" name="pseudo" placeholder="MyEcoria" required>
		</br>
		  <br>
		  <div class="h-captcha" data-sitekey="d70460c5-b57e-4361-9f18-8ff853341f8a" data-theme="dark" data-size="compact"></div>
		</br>
		  <input type="submit" value="Go">
		  <?php echo "h".$responseduino; ?>
		</br>
	</br>
		</form>
	</div>

	<script type="text/javascript">
		$("form").submit(function(event) {

		   var hcaptchaVal = $('[name=h-captcha-response]').value;
		   if (hcaptchaVal === "") {
		      event.preventDefault();
		      alert("Please complete the hCaptcha");
		   }
		});
	</script>
</body>
</html>