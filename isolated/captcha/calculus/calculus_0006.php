<?php

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);

	if (isset($_POST["extra"]) && is_string($_POST["extra"])) {
		$extra = aes_decrypt($_POST["extra"], APP_KEY);
		switch ($extra) {
			case "0001": return $answer === "5";
			case "0002": return $answer === "2.5";
			case "0003": return $answer === "30";
			case "0004": return $answer === "10";
			default:
				return false;
				break;
		}
	}

	return false;
}

$extra = sprintf("%04d", rand(1, 4));

?>
<div>
<p>Find the radius of the circle with equation <br/><img src="<?php print captcha_asset("calculus/assets/calculus_0005_{$extra}.png"); ?>"/></p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<input type="hidden" name="extra" value="<?php print htmlspecialchars(aes_encrypt($extra, APP_KEY), ENT_QUOTES, "UTF-8"); ?>"/>
<?php require __DIR__."/000_form.php"; ?>
</div>