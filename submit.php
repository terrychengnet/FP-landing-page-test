<div class="main" style="display:block; position: absolute; top: 0; right: 0; bottom: 0; left: 0; background: #307fe2;">
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_POST['form-name']) || !isset($_POST['form-email'])) {
        header('Location: http://local.fp-landing.com/');
    }

	$subscribed = false;

    $data_center = 'us18';
    $audience_id = '5f8e0e8143';
    $api_key = '626bb341ae0b9fd680cc8de921b9531e-us18';
    $url = 'https://' . $data_center . '.api.mailchimp.com/3.0/lists/' . $audience_id . '/members';

    $user_details = [
        'email_address' => $_POST['form-email'],
        'status' => 'subscribed'
    ];
    $user_details = json_encode($user_details);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLINFO_HEADER_OUT, true);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_USERPWD, 'newsletter:' . $api_key);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $user_details);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
		'Content-Length: ' . strlen($user_details)
	]);
	$result = curl_exec($ch);
	$result_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);

    if ($result_code === 200) {
		$subscribed = true;
  	}

	if ($subscribed) {
		echo '<span style="color: white; font-size: 20px; position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%);">' . 'You have been subscribed!' . '</span>';
	} else {
		echo '<span style="color: white; font-size: 20px; position: absolute; left: 50%; top: 50%; transform: translate(-50%,-50%);">' . 'Something went wrong' . '</span>';
	}

} else {
    header('Location: http://local.fp-landing.com/');
}
?>
</div>