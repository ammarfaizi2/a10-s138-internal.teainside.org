<?php

$correctAnswer = "13";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

?>
<div>
<p><img src="<?php print captcha_asset("calculus/assets/calculus_0008_0001.png"); ?>"/></p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>