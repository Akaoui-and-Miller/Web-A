   <?php 
    require("config.php");
    if(!empty($_POST)) 
    { 
        // Ensure that the user fills out fields 
        if(empty($_POST['username'])) 
        { die("Please enter a username."); } 
        if(empty($_POST['password'])) 
        { die("Please enter a password."); } 
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { die("Invalid E-Mail Address"); } 
         
        // Check if the username is already taken
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
        $query_params = array( ':username' => $_POST['username'] ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch(); 
        if($row){ die("This username is already in use"); } 
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage());} 
        $row = $stmt->fetch(); 
        if($row){ die("This email address is already registered"); } 
         
        // Add row to database 
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
         
        // Security measures
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
        $password = hash('sha256', $_POST['password'] . $salt); 
        for($round = 0; $round < 65536; $round++){ $password = hash('sha256', $password . $salt); } 
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
        try {  
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex){ die("Failed to run query: " . $ex->getMessage()); } 
        header("Location: index.html"); 
        die("Redirecting to index.html"); 
    } 
?>
<!-- Author: Michael Milstead / Mode87.com
     for Untame.net
     Bootstrap Tutorial, 2013
-->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Item - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-item.css" rel="stylesheet">
    
    <link href="css/reviewcss.css" rel="stylesheet" type="text/css">
    
    
    <script src="js/reviewjs.js"></script>
    <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
        });
    </script>
    <!-- Login CSS -->
    <link href="css/login-style.css" rel="stylesheet">
    <style type="text/css">
    @import url("../webfonts/BADABB/stylesheet.css");
body,td,th {
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif, BADABB;
}
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Home</a>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="About.html">About</a>
                    </li>
               
                    <li>
                        <a href="Contact.html">Contact</a>
                    </li>
                  
                    <li>
                    	<a href=".forums\index.php">
                        Forums</a>
                  </li>
                
                    <li>
                    	<a href="mailto:support@millerprogramming.com?Subject=Support">
                        Support</a>
                    </li>
              </ul>
                                  <div>
<!-- Authentication Begin -->

        <ul class="nav pull-right">
          <li><a href="register.php">Register</a></li>
          <li class="divider-vertical"></li></ul>
          <ul class="nav pull-right">
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Log In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 15px;">
                <form action="login.php" method="post"> 
                    Username:<br /> 
                    <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                    <br /><br /> 
                    Password:<br /> 
                    <input type="password" name="password" value="" /> 
                    <br /><br /> 
                    <input type="submit" class="btn btn-info" value="Login" /> 
                </form> 
            </div>
          </li>
        </ul>


                </div>

            </div>

    <!-- Authentication End -->
            <!-- /.navbar-collapse -->
        <!-- /.container -->
   </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">HotLaptop</p>
                <div class="list-group">
                    <a href="#" class="list-group-item">Gaming</a> <br>
                    <a href="#" class="list-group-item">Business</a> <br>
                    <a href="#" class="list-group-item">Personal</a>
                    <br>
                    <a href="#" class="list-group-item">Tablets</a>
                </div>
            </div>

   <div class="col-md-9">
   
<div class="container hero-unit">
    <h1>Register</h1> <br /><br />
    <form action="register.php" method="post"> 
        <label>Username: <strong style="color:darkred;">*</strong></label> 
        <input type="text" name="username" value="" /> 
        <label>Email: <strong style="color:darkred;">*</strong></label> 
        <input type="text" name="email" value="" /> 
        <label>Password: <strong style="color:darkred;">*</strong></label> 
        <input type="password" name="password" value="" /> <br /><br />
        <p style="color:darkred;">Fields with * next to them require you to fill them in.</p><br />
        <input type="submit" class="btn btn-info" value="Register" /> 
    </form>
</div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; HotLaptop 2015</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/reviewimportant.js"></script>

</body>

</html>
