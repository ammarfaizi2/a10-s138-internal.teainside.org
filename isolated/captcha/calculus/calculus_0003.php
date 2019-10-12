<?php

$correctAnswer = "x=2";

if (isset($checkAnswer)) {
	$answer = str_replace(" ", "", $answer);
	return $answer === $correctAnswer;
}

?>
<div>
<p>What is the equation for the line that passes the point (2, -5) and is parallel to the y-axis?<br/><br/>(write the answer in  format x=c).</p>
<div>Answer :</div>
<input id="answer" type="text" name="answer" required/>
<?php require __DIR__."/000_form.php"; ?>
</div>