<?php
	session_start();
	$api = 'http://localhost:3000';
  require_once("api/call.php");
  $cates = CallAPI('GET', '/categories');
  $cate_groups = json_decode(CallAPI('GET', '/categories/groups'))->data;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="Magz is a HTML5 & CSS3 magazine template is based on Bootstrap 3.">
		<meta name="author" content="Kodinger">
		<meta name="keyword" content="magz, html5, css3, template, magazine template">
		<!-- Shareable -->
		<meta property="og:title" content="HTML5 & CSS3 magazine template is based on Bootstrap 3" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="http://github.com/nauvalazhar/Magz" />
		<meta property="og:image" content="https://raw.githubusercontent.com/nauvalazhar/Magz/master/images/preview.png" />
		<title>Magz &mdash; Responsive HTML5 &amp; CSS3 Magazine Template</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
		<!-- IonIcons -->
		<link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
		<!-- Toast -->
		<link rel="stylesheet" href="scripts/toast/jquery.toast.min.css">
		<!-- OwlCarousel -->
		<link rel="stylesheet" href="scripts/owlcarousel/dist/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="scripts/owlcarousel/dist/assets/owl.theme.default.min.css">
		<!-- Magnific Popup -->
		<link rel="stylesheet" href="scripts/magnific-popup/dist/magnific-popup.css">
		<link rel="stylesheet" href="scripts/sweetalert/dist/sweetalert.css">
		<!-- Custom style -->
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/skins/all.css">
		<link rel="stylesheet" href="css/demo.css">
	</head>

	<body>
		<header class="primary">
			<div class="firstbar">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-sm-12">
							<div class="brand">
								<a href="index.html">
									<img src="images/logo.png" alt="Magz Logo">
								</a>
							</div>						
						</div>
						<div class="col-md-6 col-sm-12">
							<form class="search" autocomplete="off">
								<div class="form-group">
									<div class="input-group">
										<input type="text" name="q" class="form-control" placeholder="Type something here">									
										<div class="input-group-btn">
											<button class="btn btn-primary"><i class="ion-search"></i></button>
										</div>
									</div>
								</div>
								<div class="help-block">
									<div>Popular:</div>
									<ul>
										<?php
											$categories = json_decode($cates);
											$categories_data = $categories->data;
											if (!empty($categories_data)) { 
    										foreach($categories_data as $key=>$value){
										?>
											<li><a href="category.php?id=<?php echo $value->id ?>"><?php echo $value->name ?></a></li>
									  <?php
									      }
									  	}
									  ?>
									</ul>
								</div>
							</form>								
						</div>
						<div class="col-md-3 col-sm-12 text-right">
							<ul class="nav-icons">
								<?php
									if ($_SESSION['loggedin']) {
								?>
										<li><a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="ion-person"></i><div><?php echo $_SESSION['user_name'] ?></div></a></li>
										<li><a href="logout.php"><i class="ion-log-out"></i><div>Logout</div></a></li>
								<?php
									} else {
								?>
										<li><a href="register.php"><i class="ion-person-add"></i><div>Register</div></a></li>
										<li><a href="login.php"><i class="ion-person"></i><div>Login</div></a></li>
								<?php
									}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Start nav -->
			<nav class="menu">
				<div class="container">
					<div class="brand">
						<a href="#">
							<img src="images/logo.png" alt="Magz Logo">
						</a>
					</div>
					<div class="mobile-toggle">
						<a href="#" data-toggle="menu" data-target="#menu-list"><i class="ion-navicon-round"></i></a>
					</div>
					<div class="mobile-toggle">
						<a href="#" data-toggle="sidebar" data-target="#sidebar"><i class="ion-ios-arrow-left"></i></a>
					</div>
					<div id="menu-list">
						<ul class="nav-list">
							<li class="for-tablet nav-title"><a>Menu</a></li>
							<li class="for-tablet"><a href="login.php">Login</a></li>
							<li class="for-tablet"><a href="register.php">Register</a></li>
							<li><a href="index.php">Home</a></li>
							<li><a href="tags.php">Tags</a></li>
							<li class="dropdown magz-dropdown magz-dropdown-megamenu"><a href="#">Category <i class="ion-ios-arrow-right"></i></a>
                <div class="dropdown-menu megamenu">
                  <div class="megamenu-inner">
                    <div class="row">
                    	<?php foreach($cate_groups as $key=>$value) { ?>
                      <div class="col-md-3">
                        <ul class="vertical-menu">
                        	<?php foreach($value as $key1=>$value1) { ?>
                        	<li><a href="category.php?id=<?php echo $value1->id ?>"><?php echo $value1->name ?></a></li>
                        	<?php } ?>
                        </ul>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </li>
              <?php if ($_SESSION['loggedin']) { ?>
							<li class="dropdown magz-dropdown"><a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>">Profile <i class="ion-ios-arrow-right"></i></a>
								<ul class="dropdown-menu">
									<li><a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="icon ion-person"></i> My Account</a></li>
									<li><a href="profile_form.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="icon ion-settings"></i> Update Profile</a></li>
									<li><a href="question_form.php"><i class="icon ion-android-add-circle"></i>Add Question</a></li>
									<li class="divider"></li>
									<li><a href="logout.php"><i class="icon ion-log-out"></i> Logout</a></li>
								</ul>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</nav>
			<!-- End nav -->
		</header>

		<section class="login first grey">
			<div class="container">
				<div class="box-wrapper">				
					<div class="box box-border">
						<div class="box-body">
							<h4>Login</h4>
							<form class="login-form">
								<div class="form-group">
									<label>Email</label>
									<input type="text" name="email" class="form-control email">
								</div>
								<div class="form-group">
									<label class="fw">Password
										<a href="forgot.html" class="pull-right">Forgot Password?</a>
									</label>
									<input type="password" name="password" class="form-control password">
								</div>
								<div class="form-group text-right">
									<button id="login-btn" type="button" class="btn btn-primary btn-block">Login</button>
								</div>
								<div class="form-group text-center">
									<span class="text-muted">Don't have an account?</span> <a href="register.html">Create one</a>
								</div>
								<div class="title-line">
									or
								</div>
              	<a href="#" class="btn btn-social btn-block facebook"><i class="ion-social-facebook"></i> Login with Facebook</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Start footer -->
		<footer class="footer">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="copyright">
							COPYRIGHT &copy; eMagazine. ALL RIGHT RESERVED.
							<div>
								Made with <i class="ion-heart"></i> by DaiHo
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- End Footer -->

		<!-- JS -->
		<script src="js/jquery.js"></script>
		<script src="js/jquery.migrate.js"></script>
		<script src="scripts/bootstrap/bootstrap.min.js"></script>
		<script>var $target_end=$(".best-of-the-week");</script>
		<script src="scripts/jquery-number/jquery.number.min.js"></script>
		<script src="scripts/owlcarousel/dist/owl.carousel.min.js"></script>
		<script src="scripts/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
		<script src="scripts/easescroll/jquery.easeScroll.js"></script>
		<script src="scripts/sweetalert/dist/sweetalert.min.js"></script>
		<script src="scripts/toast/jquery.toast.min.js"></script>
		<script src="js/demo.js"></script>
		<script src="js/e-magz.js"></script>
		<script src="js/application.js"></script>
		<script src="js/user.js"></script>
	</body>
</html>