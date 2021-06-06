<?php
  session_start();
  require_once("api/call.php");
  $api = 'http://localhost:3000';
  $cates = json_decode(CallAPI('GET', '/categories'))->data;
  $username = $_SESSION['user_name'] ? $_SESSION['user_name'] : '';
  $authenticated_data = $_SESSION['loggedin'] ? array("authenticated" => true) : array();
  parse_str($_SERVER['QUERY_STRING'], $params);
  $data = json_decode(CallAPI('GET', '/questions/'.$params['id'], $_SESSION['loggedin'], $authenticated_data))->data;
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

    <section class="single">
      <div class="container">
        <div class="row">
          <div class="col-md-4 sidebar" id="sidebar">
            <aside>
              <h1 class="aside-title">Recent Post</h1>
              <div class="aside-body">
                <article class="article-fw">
                  <div class="inner">
                    <figure>
                      <a href="question.php">                        
                        <img src="images/news/img16.jpg">
                      </a>
                    </figure>
                    <div class="details">
                      <h1><a href="question.php">Lorem Ipsum Dolor Sit Amet Consectetur Adipisicing Elit</a></h1>
                      <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua.
                      </p>
                      <div class="detail">
                        <div class="time">December 26, 2016</div>
                        <div class="category"><a href="category.html">Lifestyle</a></div>
                      </div>
                    </div>
                  </div>
                </article>
                <div class="line"></div>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img05.jpg">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                      <div class="detail">
                        <div class="category"><a href="category.html">Lifestyle</a></div>
                        <div class="time">December 22, 2016</div>
                      </div>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img02.jpg">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
                      <div class="detail">
                        <div class="category"><a href="category.html">Travel</a></div>
                        <div class="time">December 21, 2016</div>
                      </div>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img13.jpg">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                      <div class="detail">
                        <div class="category"><a href="category.html">International</a></div>
                        <div class="time">December 20, 2016</div>
                      </div>
                    </div>
                  </div>
                </article>
              </div>
            </aside>
          </div>
          <div class="col-md-8">
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li class="active">Question</li>
            </ol>
            <article class="article main-article">
              <header>
                <ul class="details">
                  <li><?php echo $data->created_at ?></li>
                  <li><a>Question</a></li>
                  <li>By <a href="profile.php?id=<?php echo $data->creator->id ?>"><?php echo $data->creator->name ?></a></li>
                </ul>
              </header>
              <div class="main">
                <div class="featured">
                  <figure>
                    <img src="<?php echo $api.$data->image ?>">
                    <figcaption>Featured Image</figcaption>
                  </figure>
                </div>
                <p>
                  <?php echo $data->content ?>
                </p>
              </div>
              <footer>
                <div class="col">
                  <ul class="tags">
                    <?php foreach($data->tags as $key=>$value) { ?>
                      <li><a href="questions.php?tag=<?php echo $value->name ?>"><?php echo $value->name ?></a></li>
                    <?php } ?>
                  </ul>
                </div>
                <div class="col">
                  <?php $liked = $data->liked == true ? 'active' : '' ?>
                  <a href="#" class="love <?php echo $liked ?>" data-questionid="<?php echo $data->id ?>"><i class="ion-android-favorite"></i> <div><?php echo $data->likes ?></div></a>
                </div>
              </footer>
            </article>
            <div class="sharing">
            <div class="title"><i class="ion-android-share-alt"></i> Sharing is caring</div>
              <ul class="social">
                <li>
                  <a href="#" class="facebook">
                    <i class="ion-social-facebook"></i> Facebook
                  </a>
                </li>
                <li>
                  <a href="#" class="twitter">
                    <i class="ion-social-twitter"></i> Twitter
                  </a>
                </li>
                <li>
                  <a href="#" class="googleplus">
                    <i class="ion-social-googleplus"></i> Google+
                  </a>
                </li>
                <li>
                  <a href="#" class="linkedin">
                    <i class="ion-social-linkedin"></i> Linkedin
                  </a>
                </li>
                <li>
                  <a href="#" class="skype">
                    <i class="ion-ios-email-outline"></i> Email
                  </a>
                </li>
                <li class="count">
                  20
                  <div>Shares</div>
                </li>
              </ul>
            </div>
            <div class="line">
              <div>Author</div>
            </div>
            <div class="author">
              <figure>
                <img src="images/img01.jpg">
              </figure>
              <div class="details">
                <!-- <div class="job">Web Developer</div> -->
                <h3 class="name"><?php echo $data->creator->name?></h3>
                <ul class="social trp sm">
                  <li>
                    <a href="#" class="facebook">
                      <svg><rect/></svg>
                      <i class="ion-social-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                      <svg><rect/></svg>
                      <i class="ion-social-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="youtube">
                      <svg><rect/></svg>
                      <i class="ion-social-youtube"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="googleplus">
                      <svg><rect/></svg>
                      <i class="ion-social-googleplus"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="line"><div>You May Also Like</div></div>
            <div class="row">
              <article class="article related col-md-6 col-sm-6 col-xs-12">
                <div class="inner">
                  <figure>
                    <a href="#">
                      <img src="images/news/img03.jpg">
                    </a>
                  </figure>
                  <div class="padding">
                    <h2><a href="#">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                    <div class="detail">
                      <div class="category"><a href="category.html">Lifestyle</a></div>
                      <div class="time">December 26, 2016</div>
                    </div>
                  </div>
                </div>
              </article>
              <article class="article related col-md-6 col-sm-6 col-xs-12">
                <div class="inner">
                  <figure>
                    <a href="#">
                      <img src="images/news/img08.jpg">
                    </a>
                  </figure>
                  <div class="padding">
                    <h2><a href="#">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                    <div class="detail">
                      <div class="category"><a href="category.html">Lifestyle</a></div>
                      <div class="time">December 26, 2016</div>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="line thin"></div>
            <div class="comments">
              <h2 class="title"><span id="comments_count"><?php echo count($data->comments) ?></span> Responses <a href="#reply">Write a Response</a></h2>
              <div class="comment-list">
                <?php foreach($data->comments as $key=>$value) { ?>
                  <div class="item">
                    <div class="user">                                
                      <figure>
                        <img src="images/img01.jpg">
                      </figure>
                      <div class="details">
                        <h5 class="name"><?php echo $value->creator->name ?></h5>
                        <div class="time"><?php echo $value->created_at ?></div>
                        <div class="description">
                          <?php echo $value->content ?>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
              <form class="row" id="reply">
                <div class="col-md-12">
                  <h3 class="title">Leave Your Response</h3>
                </div>
                <input class="form-control token" name="token" type="hidden" value="<?php echo $_SESSION['user_token'] ?>"></input>
                <input class="form-control userid" name="userid" type="hidden" value="<?php echo $_SESSION['user_id'] ?>"></input>
                <input class="form-control user_name" name="user_name" type="hidden" value="<?php echo $_SESSION['user_name'] ?>"></input>
                <input class="form-control question" name="question" type="hidden" value="<?php echo $data->id ?>"></input>
                <div class="form-group col-md-12">
                  <label for="message">Response <span class="required"></span></label>
                  <textarea class="form-control message" name="message" placeholder="Write your response ..."></textarea>
                </div>
                <div class="form-group col-md-12">
                  <button type="button" class="btn btn-primary submit">Send Response</button>
                </div>
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
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="block">
              <h1 class="block-title">Company Info</h1>
              <div class="block-body">
                <figure class="foot-logo">
                  <img src="images/logo-light.png" class="img-responsive" alt="Logo">
                </figure>
                <p class="brand-description">
                  Magz is a HTML5 &amp; CSS3 magazine template based on Bootstrap 3.
                </p>
                <a href="page.html" class="btn btn-magz white">About Us <i class="ion-ios-arrow-thin-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="block">
              <h1 class="block-title">Popular Tags <div class="right"><a href="#">See All <i class="ion-ios-arrow-thin-right"></i></a></div></h1>
              <div class="block-body">
                <ul class="tags">
                  <li><a href="#">HTML5</a></li>
                  <li><a href="#">CSS3</a></li>
                  <li><a href="#">Bootstrap 3</a></li>
                  <li><a href="#">Web Design</a></li>
                  <li><a href="#">Creative Mind</a></li>
                  <li><a href="#">Standing On The Train</a></li>
                  <li><a href="#">at 6.00PM</a></li>
                </ul>
              </div>
            </div>
            <div class="line"></div>
            <div class="block">
              <h1 class="block-title">Newsletter</h1>
              <div class="block-body">
                <p>By subscribing you will receive new articles in your email.</p>
                <form class="newsletter">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="ion-ios-email-outline"></i>
                    </div>
                    <input type="email" class="form-control email" placeholder="Your mail">
                  </div>
                  <button class="btn btn-primary btn-block white">Subscribe</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="block">
              <h1 class="block-title">Latest News</h1>
              <div class="block-body">
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img12.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Donec consequat lorem quis augue pharetra</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img14.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">eu dapibus risus aliquam etiam ut venenatis</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img15.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Nulla facilisis odio quis gravida vestibulum </a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img16.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Proin venenatis pellentesque arcu vitae </a></h1>
                    </div>
                  </div>
                </article>
                <a href="#" class="btn btn-magz white btn-block">See All <i class="ion-ios-arrow-thin-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-xs-12 col-sm-6">
            <div class="block">
              <h1 class="block-title">Follow Us</h1>
              <div class="block-body">
                <p>Follow us and stay in touch to get the latest news</p>
                <ul class="social trp">
                  <li>
                    <a href="#" class="facebook">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="twitter">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-twitter-outline"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="youtube">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-youtube-outline"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="googleplus">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-googleplus"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="instagram">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-instagram-outline"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="tumblr">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-tumblr"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="dribbble">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-dribbble"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="linkedin">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-linkedin"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="skype">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-skype"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="rss">
                      <svg><rect width="0" height="0"/></svg>
                      <i class="ion-social-rss"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="line"></div>
            <div class="block">
              <div class="block-body no-margin">
                <ul class="footer-nav-horizontal">
                  <li><a href="index.html">Home</a></li>
                  <li><a href="#">Partner</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li><a href="page.html">About</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="copyright">
              COPYRIGHT &copy; MAGZ 2017. ALL RIGHT RESERVED.
              <div>
                Made with <i class="ion-heart"></i> by <a href="http://kodinger.com">Kodinger</a>
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
    <script src="js/questions.js"></script>
    <script src="js/e-magz.js"></script>
  </body>
</html>