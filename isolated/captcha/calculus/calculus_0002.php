<?php

$correctAnswer = "y=-5";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

?>
<div>
<p>What is the equation for the line that passes the point (2, -5) and is parallel to the x-axis?<br/>(write the answer in y=c format).</p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>