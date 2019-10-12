<?php

$correctAnswer = "y=-3x+1";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

?>
<div>
<p>What is the equation for the line that passes the point (2, -5) and has slope -3? <br/>(write the answer in y=mx+c format).</p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>