<?php

$correctAnswer = "(x-a)^2+(y-b)^2=52";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

$p = ["What is", "Find"][rand(0, 1)];

?>
<div>
<p><?php print $p; ?> the equation for the circle that has center (-1, 4) and passes through the point (3, -2)?<br/><br/>(write the answer in  format (x-a)^2 + (y-b)^2 = r^2).</p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>