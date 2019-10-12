<?php

$problem = "What is the equation for the circle that has center (-1, 4) and passes through the point (3, -2)? (write the answer in (x-a)^2 + (y-b)^2 = r^2 format).";
$correctAnswer = "(x-a)^2+(y-b)^2=52";

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