<?php

include '/includes/header.php';

if (isset($_POST['submit'])){
    echo "<script>alert('You have been added to the waiting list. Please wait for an email from the admin');</script>";
}

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
        <h1>Welcome</h1>
        <p>Thanks for choosing the Purely Server managment solution.</p>
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-6">
          <h2>Sign up for a server</h2>
          <p>Student and staff of Plymouth University can sign up for one of our top notch servers. Its a quick and simple process.</p>
          <p><a class="btn btn-default" href="signup.php" role="button">Sign up &raquo;</a></p>
        </div>
        <div class="col-md-6">
          <h2>Server admin</h2>
          <p>Sign in to manage server resources, users and other servery stuff</p>
          <p><a class="btn btn-default" href="login.php" role="button">Sign in &raquo;</a></p>
       </div>
      </div>

      <hr>

      <footer>
        <p>&copy; Company 2014</p>
      </footer>
    </div> <!-- /container -->

<?php

include '/includes/footer.php';

?>