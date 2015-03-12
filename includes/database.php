<?php


// database connection
function connectToDatabase(){

	// these variables would usually be in a seperate file strored outside of the www folder for security
	$host = 'localhost';
	$user = 'root';
	$password = "";
	$database = '235_servers';

	// create the database connection
	$db = new mysqli($host, $user, $password, $database);

	// if no connection made throw an error
	if ($db->connect_error){
	    $error = $db->connect_error;

	    echo 'Connection Error :'.$error;
	} else {
		// return connection to the calling page
	    return $db;
	}
}

createDatabase();
function createDatabase(){

	//TODO
	// create database if it dosnt exist

	//check for tables

	// if there are no tables, create them.

	// or I could just export the database

}

//--------------------------SQL Statements---------------------------//

//--------------------------USERS---------------------------//

// select all unauthorised users
function executeUserSelect($sql, $db){

	// initaialise the statement
    $stmt = $db->stmt_init();

    // prepare the statement, if that dosn't work echo error message
    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

    	// execute statement, if that dosn't work thow error message
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        // bing the results to variable names to save my sanity
        $stmt->bind_result($firstName, $lastName, $email, $houseNumber, $street,
            $city, $postcode, $authorised, $school, $userId);

        // initialise empty array and counter
        $results = array();
        $i = 0;

        // loop over the results, creating an array for return
        while ($stmt->fetch()){
            $results[$i] = [$firstName, $lastName, $email, $houseNumber, $street,
                $city, $postcode, $authorised, $school, $userId];
            $i++;
        }

        // return the array, filling the requesting variable
        return $results;
    }
}

// update user status to authorised
function updateUserSatus($user, $db, $sql){

    $stmt = $db->stmt_init();
    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

        $stmt->bind_param('i', $user);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        echo '<script>alert("Succesfully authorised user")</script>;';

        // "refresh" the page to remove the authorised user
        echo '<script>window.location.href = "userAuthorisation.php";</script>';
    }
}

// select users by faculty
function executeUserBySchoolSelect($sql, $db, $faculty){
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

    	$stmt->bind_param('s', $faculty);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->bind_result($firstName, $lastName, $email, $houseNumber, $street,
            $city, $postcode, $authorised, $school, $userId);

        $results = array();
        $i = 0;

        while ($stmt->fetch()){
            $results[$i] = [$firstName, $lastName, $email, $houseNumber, $street,
                $city, $postcode, $authorised, $school, $userId];
            $i++;
        }
        return $results;
    }
}

// get the full list of faculties / schools
function executeFacultySelect($sql, $db){
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->bind_result($id, $faculty, $location);

        $results = array();
        $i = 0;

        while ($stmt->fetch()){
            $results[$i] = [$id, $faculty, $location];
            $i++;
        }
        return $results;
    }	
}

function addNewUser($mypost, $sql, $db){

	// sanitise the user input

	// check the user email for the plymouth uni email string
	if (checkUniEmail($mypost['email'])){
        $email = prepareString($mypost['email']);
    } else {
        echo "<script>alert('The email must be a valid Plymouth University Email address');</script>";
    }

    $firstName = prepareString($mypost['firstName']);
    $lastName = prepareString($mypost['lastName']);
    $houseNumber = prepareInt($mypost['houseNumber']);
    $street = prepareString($mypost['street']);
    $city = prepareString($mypost['city']);
    $postcode = prepareString($mypost['postcode']);
    $school = prepareString($mypost['schoolSelect']);

    //execute the query
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

        $stmt->bind_param('sssissss', $firstName, $lastName, $email, $houseNumber, $street, $city, $postcode, $school);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        // Redirect the user to the homepage. Feedback givenon the homepage
        header('Location: index.php');
    }
}

//--------------------------SERVERS---------------------------//

// select all unauthorised users
function executeServerSelect($sql, $db){
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->bind_result($serverName, $serverLocation, $macAddress, $port_number, 
        	$ipAdress, $os, $admin, $comment, $id);

        $results = array();
        $i = 0;

        while ($stmt->fetch()){
            $results[$i] = [$serverName, $serverLocation, $macAddress, $port_number, 
        	$ipAdress, $os, $admin, $comment, $id];
            $i++;
        }
        return $results;
    }
}

// select all unauthorised users
function executeServerSelectFull($sql, $db, $serverID){
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

    	$stmt->bind_param('i', $serverID);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->bind_result($serverName, $serverBuilding, $serverRoom, $macAddress, $port_number, 
        	$ipAdress, $os, $admin, $comment, $id);

        $results = array();
        $i = 0;

        while ($stmt->fetch()){
            $results[$i] = [$serverName, $serverBuilding, $serverRoom, $macAddress, $port_number, 
        	$ipAdress, $os, $admin, $comment, $id];
            $i++;
        }
        return $results;
    }
}

function executeAdminSelect($sql, $db){
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->bind_result($adminID, $name);

        $results = array();
        $i = 0;

        while ($stmt->fetch()){
            $results[$i] = [$adminID, $name];
            $i++;
        }
        return $results;
    }
}

// update server status to archived
function updateServerSatus($server, $db, $sql){

    $stmt = $db->stmt_init();
    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

        $stmt->bind_param('i', $server);
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            die;
        }

        ?>
        
        <script type="text/javascript">
        alert("Succesfully deleted server");
        window.location.href = "servers.php";
        </script>

        <?php
    }
}

function addNewServer($myPost, $sql, $db){

	// get the new server details, sanitising the user input
    $serverName = prepareString($myPost['serverName']);
    $serverBuilding = prepareString($myPost['serverBuilding']);
    $serverRoom = prepareString($myPost['serverRoom']);
    $serverMacAddress = prepareString($myPost['macAddress']);
    $serverPortNumber = prepareInt($myPost['portNumber']);
    $serverIP = prepareString($myPost['ipAddress']);
    $operatingSystem = prepareString($myPost['operatingSystem']);
    $admin1 = prepareInt($myPost['adminSelect1']);
    $admin2 = prepareInt($myPost['adminSelect2']);
    $comments = prepareString($myPost['comments']);

    // update the database
    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

        $stmt->bind_param('ssssissiis', $serverName, $serverBuilding, $serverRoom, $serverMacAddress, $serverPortNumber, $serverIP, $operatingSystem, $admin1, $admin2, $comments);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        echo "<script>alert('The new server has been added');</script>";
        echo "<script>document.getElementById('newServer').reset();</script>";
    }
}

function deleteServer($id, $sql, $db){

    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {
        $stmt->bind_param('i', $id);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        echo "<script>alert('The new server has been added');</script>";
        echo "<script>document.getElementById('newServer').reset();</script>";
    }
}
?>