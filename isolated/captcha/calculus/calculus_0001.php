<?php

$correctAnswer = "y=-3x+1";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

$p = ["What is", "Find"][rand(0, 1)];

?>
<div>
<p><?php print $p; ?> the equation for the line that passes the point (2, -5) and has slope -3?<br/><br/>(write the answer in format y=mx+c).</p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>