<?php

$problem = "What is the equation for the line that passes the point (2, -5) and is parallel to the x-axis? (write the answer in y=c format).";
$correctAnswer = "y=-5";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

?>
<div>
<p><?php print $problem; ?></p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>