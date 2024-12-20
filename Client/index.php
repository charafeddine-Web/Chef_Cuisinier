<?php
require('./connection.php');


?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
		integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Merienda' rel='stylesheet'>
	<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
	<title>Italian Chef | charaf eddine</title>
	<link rel="icon" href="images/logo.png">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">
	<div id="Welcome">
		<nav class="navbar navbar-expand-lg navbar fixed-top  navbar-light bg-light">
			<a class="navbar-brand" href="#Welcome">
				<img src="images/logo.png" width="50" height="50" class="d-inline-block" alt=""> Chef Italian
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
				aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" href="#Welcome">Welcome</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#Restaurant">Chef</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#Menu">Menu</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#Reservation">Reservation</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#OurLocation">Our Location</a>
					</li>
				
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
		
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100 img-fluid img-slider" src="images/slider1.jpg" alt="First slide">
					<div class="carousel-caption">
						<h2>Welcome to Chef Charaf Eddine's World!</h2>
						<p>Experience the artistry of fine dining crafted by one of the most talented chefs. Let every
							dish tell a story of passion and excellence.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100 img-fluid img-slider" src="images/slider2.jpg" alt="Second slide">
					<div class="carousel-caption">
						<h2>A Culinary Journey</h2>
						<p>From signature dishes to innovative creations, Chef Charaf Eddine combines traditional
							techniques with a modern touch to redefine the dining experience.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100 img-fluid img-slider" src="images/slider3.jpg" alt="Third slide">
					<div class="carousel-caption">
						<h2>Exceptional Ingredients</h2>
						<p>Only the finest, handpicked ingredients make their way into Chef Charaf Eddine's kitchen,
							ensuring a unique and flavorful culinary adventure.</p>
					</div>
				</div>
			</div>

			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	
	<div class="container">
		<div class="row" id="Restaurant">
			<div class="col navMenu">
				<h2 class="text-center">~ Chef Charaf Eddine ~</h2>
			</div>
		</div>
		<div class="row bg-light">
			<div class="col-md-6">
				<p>Chef Charaf Eddine is a renowned culinary expert with a passion for creating unforgettable dishes.
					With years of experience and a dedication to excellence, he has mastered the art of blending
					traditional flavors with modern techniques. Every dish he prepares is a reflection of his creativity
					and love for cooking.</p>
				<h5>A Life of Culinary Passion</h5>
				<p>Growing up in a family that valued the joy of food, Chef Charaf Eddine developed his culinary skills
					at an early age. Over the years, he has honed his craft, focusing on using the finest ingredients
					and innovative methods to create dishes that leave a lasting impression. His culinary journey
					continues to inspire food enthusiasts worldwide.</p>
			</div>
			<div class="col-md-6" data-aos="fade-up">
				<img class="img-fluid" src="images/location.jpg">
			</div>
		</div>
		<div class="row bg-light"><br></div>
		<div class="row bg-light">
			<div class="col-md-6 order-md-1 order-2" data-aos="fade-up">
				<img class="img-fluid " src="images/cuisine.jpg">
			</div>
			<div class="col-md-6 order-md-12 order-1">
				<h3>Signature Creations</h3>
				<p>Thanks for stopping by. We are the last authentic Italian restaurant in Milan, serving delicious
					Italian cuisine cooked by the best chefs. It only takes a few minutes to browse through our website
					and check out our menu. We hope you'll soon join us for a superb Italian culinary experience.</p>
				<h5>A Unique Experience</h5>
				<p>Thanks for stopping by. We are the last authentic Italian restaurant in Milan, serving delicious
					Italian cuisine cooked by the best chefs. It only takes a few minutes to browse through our website
					and check out our menu. We hope you'll soon join us for a superb Italian culinary experience.</p>
			</div>
		</div>


		
		<div class="row" id="Menu">
			<div class="col navMenu">
				<h2 class="text-center">~ Menu ~</h2>
			</div>
		</div>
		<div class="row bg-light">
			<?php 
			$sql="SELECT * from Menu where Status= ? ";
			$stmt=$connect->prepare($sql);
			$status = 'Active';
			$stmt->bind_param("s", $status); 
			$stmt->execute();

			$result = $stmt->get_result();

			if ($result->num_rows > 0) {
				$count=0;
				while ($menu = $result->fetch_assoc()) {
					if ($count >= 3) break;
					echo"<div class='col-md-4' data-aos='slide-up'>";
					echo "<div class='card view zoom'>";
					echo "<img class='card-img-top img-fluid ' src=" . $menu['MenuImage'] .">";
					echo "<div class='card-body'>";
					echo "<h5 class='card-title'>~" . $menu['Title'] . "~</h5>";
					echo "<ul class='list-group list-group-flush'>";
					echo "<li class='list-group-item'>". $menu['Description'] ."</li>";
					echo "<li class='list-group-item'> " . $menu['Price'] . "$</li>";
					echo "<li class='list-group-item'>" . $menu['Status'] . "</li>";
					echo"</ul>";
					echo "</div>" ;
					echo "</div>";
					echo "</div>";
					$count++; 
				}
			} else {
				echo "Aucun menu trouvé.<br>";
			}
			$stmt->close();			
			?>
			
			
		</div>
		
		<div class="row" id="Reservation">
			<div class="col navMenu">
				<h2 class="text-center">~ Reservation ~</h2>
			</div>
		</div>
		<div class="row">
			<div class=" col-lg-12 reserve-container" data-aos="fade-up">
				<img class="img-fluid image-reserve" src="images/reserve.jpg">
				<div class="reserve-text col-lg-12 ">
					<h1 class="text-center">Timetables</h1>
					<div class="row">
						<div class="col-6">
							<h2 class="text-center">Lunch</h2>
							<h5 class="text-center">12:00 - 15:00</h5>
						</div>
						<div class="col-6">
							<h2 class="text-center">Dinner</h2>
							<h5 class="text-center">19:30 - 23:30</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="row bg-light">
			<div class="col">
				<form>
					<div class="form-row">
						<div class="form-group col-12">
							<h3>Contact Us</h3>
							<label for="inputEmail"> Email</label>
							<input type="email" class="form-control" id="inputEmail" placeholder="Email">
						</div>
						<div class="form-group col-12">
							<label for="inputName"> Name</label>
							<input type="text" class="form-control" id="inputName" placeholder="Name">
						</div>
						<div class="form-group col-12">
							<label for="inputComment"> Further requests</label>
							<textarea class="form-control" rows="4" id="inputComment"
								placeholder="Further requests"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<button type="submit" class="btn btn-secondary btn-block">Send</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	
		<div class="row" id="OurLocation">
			<div class="col navMenu">
				<h2 class="text-center">~ Our Location ~</h2>
			</div>
		</div>
		<div class="row">
			<div id="map" class="col-md-9 map"></div>
			<div class="col-md-3">
				<h3>Address:</h3>
				<p>Safi, 20159 Milan, Mailand (Lombardia) </p>
				<h3>Email:</h3>
				<p>charafeddine@example.com</p>
			</div>
		</div>
		<div class="row footer bg-light">
			<div class="col">
				<p class="text-center">Follow us: <a class="social-icon" href=""><i class="fab fa-facebook"></i></a> <a
						class="social-icon" href=""></i></a></p>
			</div>
			<div class="col">
				<p class="text-center">Copyright &copy; 2024</p>
			</div>
			<div class="col">
				<p class="text-center">Powered by: <a href="https://github.com/charafeddine-Web">Charaf eddine
						Tbibzat</a></p>
			</div>
		</div>
	</div>
	<footer class="container">
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
	</footer>
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