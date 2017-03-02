<?php

	$answer = $_POST['checkanswer'];

	if ($answer == 'austinpowers') {
		echo "<p>Yeah, baby, that's correct!</p>";
	} elseif ($answer == "bucketalgorithm") {
	    echo "<p>Yes, that is correct.</p>";
	} else {
	    echo "<p>Sorry, that was not an answer to any puzzle. Keep trying!</p>"
		echo "<p>$answer</p>"
	}

?>