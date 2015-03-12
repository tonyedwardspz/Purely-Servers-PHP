<?php

// trim whitepace and sanitise the user input.
// combined with prepared statements will prevent injection....hopefully
function prepareString($str) {
	$str = trim($str);
	$str = filter_var($str, FILTER_SANITIZE_STRING);
	$str = str_replace(";", "", $str);
	return $str;
}

// trim whitespace and sanitize integer
function prepareInt($str) {
	$str = trim($str);
	$str = filter_var($str, FILTER_SANITIZE_NUMBER_INT);
	return $str;
}

// check that the email contains the string 'plymouth.ac.uk'
function checkUniEmail($email){

	// !== used incase the position of the string starts at 0
	// which is a falsey value
	if (strpos($email, 'plymouth.ac.uk') !== false){
		return true;
	} else {
		return false;
	}
}

// set a logged in cookie when the remember me box is ticked
// replaced with one page login script
function setTheCookie($loggedIn){
	setcookie("loggedIn", $loggedIn, time()+3600);
}

// destroy (ahem) the cookie by setting to a negative time
// replaced with one page login script
function destroyTheCookie(){
	setcookie("loggedIn", "" , time()-3600);	
}

// is the row odd or even?
function getTableRowColor($i){
    if (($i % 2) == 0){
        $color = "even";
    } else {
        $color = "odd";
    }
    return $color;
}
?>