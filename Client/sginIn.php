<?php
require('./connection.php');
session_start();
$Errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));

    if (empty($email) || empty($password)) {
        $Errors[] = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $Errors[] = "Please enter a valid email address.";
    }

    if (empty($Errors)) {
        $sql_select = "SELECT * FROM users WHERE email = ?";
        $st = $connect->prepare($sql_select);

        if ($st) {
            $st->bind_param('s', $email);
            $st->execute();
            $result_select = $st->get_result();

            if ($result_select->num_rows > 0) {
                $user = $result_select->fetch_assoc();

                if (password_verify($password, $user['Password'])) {
                    $_SESSION['user_id'] = $user['UserID'];
                    $_SESSION['RoleID'] = $user['RoleID'];
                    $_SESSION['full_Name'] = $user['full_Name'];
                    $_SESSION['email'] = $user['Email'];

                    if($user['RoleID'] == 2) { 
                        header('Location: ../Admin/index.php');
                        exit();
                    }elseif ($user['RoleID'] == 3) { 
                        header('Location: ./dashboard.php');
                        exit();
                    }else {
                        $Errors[] = "Unauthorized access.";
                        session_destroy();
                        header('Location: ./SginUp.php');
                        exit();
                    }
                } else {
                    $Errors[] = "Invalid email or password.";
                }
            } else {
                $Errors[] = "No account found with this email.";
            }

            $st->close();
        } else {
            $Errors[] = "Database error: unable to prepare the query.";
        }
    }
}

// if (!empty($Errors)) {
//     foreach ($Errors as $error) {
//         echo "<p style='color: red;'>$error</p>";
//     }
// }
?>



<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet'>
	<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
	<title>Sign Up Page</title>
	<link rel="stylesheet" href="./css/login.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar fixed-top  navbar-light bg-light">
		<a class="navbar-brand" href="#Welcome">
			<img src="./images/logo.png" width="50" height="50" class="d-inline-block" alt=""> Chef Italian
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
			aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="./index.php">Welcome</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./index.php">Chef</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./index.php">Menu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="./index.php">Reservation</a>
				</li>

				<li>
					<div class="logindiv">
						<a href="./sginIn.php" class=" mx-2 sm:mx-4 " style="text-decoration: none;color:Black">Sign
							In</a>
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
			<?php if (isset($Errors) && !empty($Errors)): ?>
				<div style="background-color: #fef2f2;
				color: #7f1d1d;
				padding: 0.1rem;
				border-radius: 0.25rem;
				margin-bottom: 0.75rem;
				display: flex;
				justify-content: center;
				align-items: center;
				text-align: center;
				">
					<ul>
						<?php foreach ($Errors as $error): ?>
							<li class="text-sm"><?php echo $error; ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
			<form action="sginIn.php" method="post">
				<!-- <input type="text" name="name" placeholder="Your name" required> -->
				<input type="email" name="email" placeholder="Email" required>
				<input type="password" name="password" placeholder="Password" required>
				<button type="submit" name="submit" class="signup-btn">CREATE AN ACCOUNT</button>
				<p>or sign in with</p>
				<div class="social-buttons">
					<button class="social-btn twitter-btn">Twitter</button>
					<button class="social-btn facebook-btn">Facebook</button>
				</div>
				<p class="register-link">or <a href="./SginUp.php">Register Now</a></p>
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