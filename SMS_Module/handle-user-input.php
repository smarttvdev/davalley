<?php
	header('Content-type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8"?>';

	echo '<Response>';

	# @start snippet
	$user_pushed = (int) $_REQUEST['Digits'];
	# @end snippet

	if ($user_pushed == 1)
	{
		echo '<Dial>+16235874706</Dial>';
		echo '<say>Sorry, call failed. Try again.</say>';
		echo '<Redirect>handle-incoming-call.php</Redirect>';
	}
	elseif ($user_pushed == 2)
	{
		echo '<Say>store hours are 9 AM to 7:30 PM Monday to Friday. Saturday is 10 am to 3 PM. We are close on sunday.</Say>';
	}
	elseif ($user_pushed == 3)
	{
		echo '<Say>We are located east of 21st. avenue, in deer valley road.  The address is two zero four zero west Deer valley road in Phoenix.</Say>';
	}
	elseif ($user_pushed == 4)
	{
		echo '<Say>
First, you need to download the menu from davalleygrill.com,

Once you know what menu item you want, then to order, you just text that menu item number. Example:  If you want to order menu item 17, teriyaki chicken, then just text, 602-904-6356,  17,,


To order multiple items, text each items separated by a, slash,,.

For further help, call 623-587-4706.</Say>';
	}
	else {
		// We'll implement the rest of the functionality in the 
		// following sections.
		echo "<Say>Sorry, I can't do that yet.</Say>";
		echo '<Redirect>handle-incoming-call.php</Redirect>';
	}

	echo '</Response>';
?>