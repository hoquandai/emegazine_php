<?php
  session_start();
  require_once("api/call.php");
  $api = 'http://localhost:3000';
  $authenticated_data = $_SESSION['loggedin'] ? array("authenticated" => true) : array();
  parse_str($_SERVER['QUERY_STRING'], $params);
  $payload = array_merge($authenticated_data, array("id" => $params['id']));
  $cates = CallAPI('GET', '/categories');
  $latest_data = json_decode(CallAPI('GET', '/questions/category', $_SESSION['loggedin'], $payload))->data;
  $latest_questions = $latest_data->questions;
  $latest_likes = $latest_data->likes;
  $username = $_SESSION['user_name'] ? $_SESSION['user_name'] : '';
  $cates = CallAPI('GET', '/categories');
  $cate_groups = json_decode(CallAPI('GET', '/categories/groups'))->data;

  $ranking_users = json_decode(CallAPI('GET', '/user/ranking'))->data;
  $hot_questions = json_decode(CallAPI('GET', '/questions/hot'))->data;
  if($_SESSION['loggedin']) {
    $user_payload = 'id='.$_SESSION['user_id'];
    $data = json_decode(CallAPI('GET', '/user?'.$user_payload))->data;
    $user = $data->user;
    $questions = $data->questions;
    $stars = $data->stars;
  }
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

  <body class="skin-orange">
    <input id="user_token" type="hidden" name="token" value="<?php echo $_SESSION['user_token'] ?>"></input>
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
                  if ($username == '') {
                ?>
                    <li><a href="register.html"><i class="ion-person-add"></i><div>Register</div></a></li>
                    <li><a href="login.php"><i class="ion-person"></i><div>Login</div></a></li>
                <?php
                  } else {
                ?>
                    <li><a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>"><i class="ion-person"></i><div><?php echo $username ?></div></a></li>
                    <li><a href="logout.php"><i class="ion-log-out"></i><div>Logout</div></a></li>
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

    <section class="home">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="line">
              <div>Latest Questions</div>
            </div>
            <div class="row">
              <?php foreach ($latest_questions as $key=>$value) { ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="row">
                    <article class="article col-md-12">
                      <div class="inner">
                        <figure>
                          <a href="question.php?id=<?php echo $value->id ?>">
                            <img src="<?php echo $api.$value->image ?>" alt="Sample Article">
                          </a>
                        </figure>
                        <div class="padding">
                          <div class="detail">
                            <div class="time"><?php echo $value->created_at ?></div>
                            <div class="category"><a href="category.php?id=<?php echo $value->category->id ?>"><?php echo $value->category->name ?></a></div>
                          </div>
                          <h2><a href="qeustion.php?id=<?php echo $value->id ?>"><?php echo $value->excerpt ?></a></h2>
                          <p><?php echo $value->content ?></p>
                          <footer>
                            <?php $like_status = in_array($value->id, $latest_likes) ? 'active' : '' ?>
                            <a href="#" class="love <?php echo $like_status  ?>" data-questionid="<?php echo $value->id ?>"><i class="ion-android-favorite"></i> <div><?php echo $value->likes ?></div></a>
                            <a class="btn btn-primary more" href="question.php?id=<?php echo $value->id ?>">
                              <div>More</div>
                              <div><i class="ion-ios-arrow-thin-right"></i></div>
                            </a>
                          </footer>
                        </div>
                      </div>
                    </article>
                  </div>
                </div>
              <?php } ?>
            </div>
            <div class="line transparent little"></div>
          </div>
          <div class="col-xs-6 col-md-4 sidebar" id="sidebar">
            <div class="sidebar-title for-tablet">Sidebar</div>
            <?php if ($_SESSION['loggedin']) { ?>
            <aside>
              <div class="aside-body">
                <div class="featured-author">
                  <div class="featured-author-inner">
                    <div class="featured-author-cover" style="background-image: url('images/news/img15.jpg');">
                      <div class="badges">
                        <div class="badge-item"><i class="ion-star"></i></div>
                      </div>
                      <div class="featured-author-center">
                        <figure class="featured-author-picture">
                          <img src="<?php echo $api.$_SESSION['user_avatar'] ?>" alt="Sample Article">
                        </figure>
                        <div class="featured-author-info">
                          <h2 class="name"><?php echo $_SESSION['user_name'] ?></h2>
                          <div class="desc">@<?php echo $_SESSION['user_name'] ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="featured-author-body">
                      <div class="featured-author-count">
                        <div class="item">
                          <a>
                            <div class="name">Questions</div>
                            <div class="value"><?php echo count($questions) ?></div>                            
                          </a>
                        </div>
                        <div class="item">
                          <a>
                            <div class="name">Stars</div>
                            <div class="value"><?php echo $stars ?></div>                           
                          </a>
                        </div>
                        <div class="item">
                          <a href="profile.php?id=<?php echo $_SESSION['user_id'] ?>">
                            <div class="icon">
                              <div>More</div>
                              <i class="ion-chevron-right"></i>
                            </div>                            
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
            <?php } ?>
            <aside>
              <h1 class="aside-title">User Ranking</h1>
              <div class="aside-body comments">
                <div class="comment-list sm">
                  <?php foreach($ranking_users as $key=>$value) { ?>
                  <div class="item">
                    <a class="user" href="profile.php?id=<?php echo $value->id ?>">                                
                      <figure>
                        <img src="<?php echo $api.$value->avatar ?>" alt="User Picture">
                      </figure>
                      <div class="details">
                        <h5 class="name"><?php echo $value->name ?></h5>
                        <div class="time">SCORE: <?php echo $value->score ?></div>
                      </div>
                    </a>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </aside>
            <aside>
              <h1 class="aside-title">Question Ranking</h1>
              <div class="aside-body">
                <?php foreach($hot_questions as $key=>$value) { ?>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php?id=<?php echo $value->id ?>">
                        <img src="<?php echo $api.$value->image ?>" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php?id=<?php echo $value->id ?>"><?php echo $value->excerpt ?></a></h1>
                    </div>
                  </div>
                </article>
                <?php } ?>
              </div>
            </aside>
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
    <script src="js/application.js"></script>
    <script src="js/e-magz.js"></script>
  </body>
</html>