<?php
require('../connection.php');
session_start();
$Errors=[];

if($_SERVER['REQUEST_METHOD']== 'POST' && $_POST['submit']){
    $fullname=trim(htmlspecialchars($_POST['fullname']));
    $phone=trim(htmlspecialchars($_POST['phone']));
    $email=trim(htmlspecialchars($_POST['email']));
    $password=trim(htmlspecialchars($_POST['password']));

    if(empty($fullname) || empty($phone) || empty($email) || empty($password) ){
        $Errors[]="pleas All fiel Field ?";
    }

    $sql="INSERT into users (fullname,phone,email,password) values ('?','?','?','?') ";

    $stmt=$connect->prepare($sql);

    $stmt->bind_param('ssss',$fullname,$phone,$email,$password);
    $stmt->execute();
    $stmt->close();


} 




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Register Page</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css"></head>
<body>
<nav class="navbar navbar-expand-lg navbar fixed-top  navbar-light bg-light">
			<a class="navbar-brand" href="#Welcome">
				<img src="../images/logo.png" width="50" height="50" class="d-inline-block" alt=""> Chef Italian
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
				aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Welcome</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Chef</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Reservation</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../index.php">Our Location</a>
					</li>
					<!-- <li class="nav-item">
							<a href="#" class="language" rel="it-IT"><img src="images/italy.ico" class="flag" alt="Italiano"></a>
							<a href="index.html" class="language" rel="en-En"><img src="images/english.ico" class="flag" alt="English"></a>
						</li> -->
					<li>
						<div class="logindiv">
							<a href="./sginIn.php" class=" mx-2 sm:mx-4 "
								style="text-decoration: none;color:Black">Sign In</a>
							<button class="signup px-4 py-2 border-2 ">
								<a href="./SginUp.php" style="text-decoration: none;color:Black">Sign Up</a>
							</button>
						</div>

					</li>
				</ul>
			</div>
		</nav>

    <div class="container">
        <div class="left-content">
            <h1>Discover the art of cooking  
                <br>when you have<br>
                <strong>172 recipes</strong> ready<br> at your fingertips.
            </h1>
            <p>Experience the joy of creating culinary masterpieces faster than ever before.</p>
        </div>
        <div class="form-container">
            <form action="register.php" method="post">
                <input type="text" name="fullname" placeholder="Your Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <button type="submit" class="signup-btn">CREATE AN ACCOUNT</button>
                <p>or sign in with</p>
                <div class="social-buttons">
                    <button class="social-btn twitter-btn">Twitter</button>
                    <button class="social-btn facebook-btn">Facebook</button>
                </div>
                <p class="register-link">Already have an account? <a href="./sginIn.php">Sign In</a></p>
            </form>
        </div>
    </div>
    <!-- <footer class="container">
		<div class="row only-mobile">
			<div class="col-6">
				<a class="btn btn-primary btn-block text-center" href="tel:++390000000"><i class="fa fa-phone"
						aria-hidden="true"></i> Call</a>
			</div>
			<div class="col-6">
				<a class="btn btn-success btn-block text-center"
					href="https://api.whatsapp.com/send?phone=+390000000"><i class="fab fa-whatsapp"
						aria-hidden="true"></i> Whatsapp</a>
			</div>
		</div>
	</footer> -->
    <script src="js/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
		integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
		crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
		integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
		crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	<script type="text/javascript" src="js/map.js"></script>
	<script type="text/javascript" src="js/smooth-scroll.js"></script>
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
	<script type="text/javascript" src="js/image-effect.js"></script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDFZjOV0KA68G2YAh-rn7I3qKqCQEh_Ja0&callback=myMap">
		</script>
</body>
</html>
