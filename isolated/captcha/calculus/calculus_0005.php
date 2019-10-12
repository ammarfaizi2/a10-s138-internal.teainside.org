<?php

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);

	if (
		isset($_POST["extra"], $_POST["answer_x"], $_POST["answer_y"]) &&
		is_string($_POST["extra"]) &&
		is_string($_POST["answer_x"]) &&
		is_string($_POST["answer_y"])
	) {
		$extra = aes_decrypt($_POST["extra"], APP_KEY);
		switch ($extra) {
			case "0001": $x = 3; $y = -5; break;
			case "0002": $x = 2.5; $y = 2.5; break;
			case "0003": $x = 319; $y = 11; break;
			case "0004": $x = 9; $y = -12; break;
			default:
				return false;
				break;
		}
		return ($x == $_POST["answer_x"]) && ($y == $_POST["answer_y"]);
	}

	return false;
}

$extra = sprintf("%04d", rand(1, 4));

?>
<div>
<style type="text/css">
	#answer_x, #answer_y {
		width: 50px;
		height: 20px;
	}
	#rx {
		border: 1px solid #000;
		width: 130px;
		height: 90px;
		padding: 3px;
	}
</style>
<p>Find the center point of the circle with equation <br/><img src="<?php print captcha_asset("calculus/assets/calculus_0005_{$extra}.png"); ?>"/></p>
<div id="rx">
	<div>Answer:</div>
	<div>x = <input id="answer_x" type="number" name="answer_x" required/></div>
	<div>y = <input id="answer_y" type="number" name="answer_y" required/></div>
	<input type="hidden" name="extra" value="<?php print htmlspecialchars(aes_encrypt($extra, APP_KEY), ENT_QUOTES, "UTF-8"); ?>"/>
	<?php require __DIR__."/000_form.php"; ?>
</div>
</div>
