<?php

$correctAnswer = ["y=x/2-6", "y=(x/2)-6", "y=0.5x-6", "y=(0.5x)/6", "y=(1/2)(x)-6"];

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return in_array($answer, $correctAnswer);
}

?>
<div>
<p>What is the equation for the line that passes the point (2, -5) and is parallel to the line 2x-4y=3?<br/><br/>(write the answer in  format y=mx+c).</p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>