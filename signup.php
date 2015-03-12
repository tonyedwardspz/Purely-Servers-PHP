<?php

include '/includes/header.php';

$db = connectToDatabase();

// sql to insert new user
$sql = 'INSERT INTO users(
            first_name,
            last_name,
            email,
            house_number,
            street,
            city,
            postcode,
            school)
        VALUES (?,?,?,?,?,?,?,?)';

// if the submit button has been pressed, add new user
if (isset($_POST['submit'])){

    addNewUser($_POST, $sql, $db);
}

// get the list of faculties
$sqlFaculty = "SELECT * FROM faculty";

$faculty = executeFacultySelect($sqlFaculty, $db);


?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Server Admin</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div><!--/.navbar-collapse -->
      </div>
    </nav>


        <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1>Signup</h1>
        <p>Use the form below to sign up for a server with Plymouth University</p>
        <p>All fields are mandatory</p>
      </div>
    </div>

    <div class="container">

        <form role="form" action="" method="POST">

            <div class="col-xs-12 col-sm-12">

                <p>Please enter the information below to sign up</p>
                <p>all fields are mandatory</p>

            </div>

            <div class="col-xs-12 col-sm-6">
                
                <!-- value echos a sanitised version of the post values if there is a form error. This stops
                    an empty string causing a Notice error and a " causing an 'escape out'. -->
                <div class="form-group">
                    <label>First Name</label>
                    <input name="firstName" class="form-control" placeholder="e.g Joe" required type="text" autofocus
                    value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input name="lastName" class="form-control" placeholder="e.g. Bloggs" required type="text"
                    value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input name="email" class="form-control" placeholder="yourname@plymouth.ac.uk" required type="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">

                <div class="form-group">
                    <label>House Number</label>
                    <input name="houseNumber" class="form-control" placeholder="e.g 10" required type="number"
                    value="<?php echo isset($_POST['houseNumber']) ? htmlspecialchars($_POST['houseNumber']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Street</label>
                    <input  name="street" class="form-control" placeholder="e.g Corination Street" required type="text"
                    value="<?php echo isset($_POST['street']) ? htmlspecialchars($_POST['street']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>City / Town</label>
                    <input name="city" class="form-control" placeholder="e.g Plymouth" required type="text"
                    value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Postcode</label>
                    <input name="postcode" class="form-control" placeholder="e.g PL9 9BS" required type="text" maxlength="9"
                    value="<?php echo isset($_POST['postcode']) ? htmlspecialchars($_POST['postcode']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label>Select School</label>
                    <select class="form-control" name="schoolSelect" id="selectBox">
                        
                        <!-- Set a unselectable option for initial page load  -->
                        <option disabled selected> -- select an option -- </option>
                        <?php
                        foreach ($faculty as $key) { ?>

                        <option value="<?php echo $key['0']; ?>">
                            <?php echo $key['1']; ?>
                        </option>

                        <?php } ?>
                    </select>
                </div>                

            </div>            
                
            <button name="submit" type="submit" class="btn btn-default">Submit</button>
            <button type="reset" class="btn btn-default">Reset</button>

        </form>
    </div> <!-- /container -->

<?php

include '/includes/footer.php';

?>