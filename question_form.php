<?php
  session_start();
  require_once("api/call.php");
  $cates = json_decode(CallAPI('GET', '/categories'))->data;
  $username = $_SESSION['user_name'] ? $_SESSION['user_name'] : '';
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
                    <li><a href="#">HTML5</a></li>
                    <li><a href="#">CSS3</a></li>
                    <li><a href="#">Bootstrap 3</a></li>
                    <li><a href="#">jQuery</a></li>
                    <li><a href="#">AnguarJS</a></li>
                  </ul>
                </div>
              </form>               
            </div>
            <div class="col-md-3 col-sm-12 text-right">
              <ul class="nav-icons">
                <li><a href="register.html"><i class="ion-person-add"></i><div>Register</div></a></li>
                <li><a href="login.html"><i class="ion-person"></i><div>Login</div></a></li>
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
              <li class="for-tablet"><a href="login.html">Login</a></li>
              <li class="for-tablet"><a href="register.html">Register</a></li>
              <li><a href="category.html">Standard</a></li>
              <li class="dropdown magz-dropdown">
                <a href="category.html">Pages <i class="ion-ios-arrow-right"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="index.html">Home</a></li>
                  <li class="dropdown magz-dropdown">
                    <a href="#">Authentication <i class="ion-ios-arrow-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="login.html">Login</a></li>
                      <li><a href="register.html">Register</a></li>
                      <li><a href="forgot.html">Forgot Password</a></li>
                      <li><a href="reset.html">Reset Password</a></li>
                    </ul>
                  </li>
                  <li><a href="category.html">Category</a></li>
                  <li><a href="single.html">Single</a></li>
                  <li><a href="page.html">Page</a></li>
                  <li><a href="search.html">Search</a></li>
                  <li><a href="contact.html">Contact</a></li>
                  <li class="dropdown magz-dropdown">
                    <a href="#">Error <i class="ion-ios-arrow-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="403.html">403</a></li>
                      <li><a href="404.html">404</a></li>
                      <li><a href="500.html">500</a></li>
                      <li><a href="503.html">503</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown magz-dropdown"><a href="#">Dropdown <i class="ion-ios-arrow-right"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="category.html">Internet</a></li>
                  <li class="dropdown magz-dropdown"><a href="category.html">Troubleshoot <i class="ion-ios-arrow-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="category.html">Software</a></li>
                      <li class="dropdown magz-dropdown"><a href="category.html">Hardware <i class="ion-ios-arrow-right"></i></a>
                        <ul class="dropdown-menu">
                          <li><a href="category.html">Main Board</a></li>
                          <li><a href="category.html">RAM</a></li>
                          <li><a href="category.html">Power Supply</a></li>
                        </ul>
                      </li>
                      <li><a href="category.html">Brainware</a>
                    </ul>
                  </li>
                  <li><a href="category.html">Office</a></li>
                  <li class="dropdown magz-dropdown"><a href="#">Programming <i class="ion-ios-arrow-right"></i></a>
                    <ul class="dropdown-menu">
                      <li><a href="category.html">Web</a></li>
                      <li class="dropdown magz-dropdown"><a href="category.html">Mobile <i class="ion-ios-arrow-right"></i></a>
                        <ul class="dropdown-menu">
                          <li class="dropdown magz-dropdown"><a href="category.html">Hybrid <i class="ion-ios-arrow-right"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="#">Ionic Framework 1</a></li>
                              <li><a href="#">Ionic Framework 2</a></li>
                              <li><a href="#">Ionic Framework 3</a></li>
                              <li><a href="#">Framework 7</a></li>
                            </ul>
                          </li>
                          <li><a href="category.html">Native</a></li>
                        </ul>
                      </li>
                      <li><a href="category.html">Desktop</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown magz-dropdown magz-dropdown-megamenu"><a href="#">Mega Menu <i class="ion-ios-arrow-right"></i> <div class="badge">Hot</div></a>
                <div class="dropdown-menu megamenu">
                  <div class="megamenu-inner">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="row">
                          <div class="col-md-12">
                            <h2 class="megamenu-title">Trending</h2>
                          </div>
                        </div>
                        <ul class="vertical-menu">
                          <li><a href="#"><i class="ion-ios-circle-outline"></i> Mega menu is a new feature</a></li>
                          <li><a href="#"><i class="ion-ios-circle-outline"></i> This is an example</a></li>
                          <li><a href="#"><i class="ion-ios-circle-outline"></i> For a submenu item</a></li>
                          <li><a href="#"><i class="ion-ios-circle-outline"></i> You can add</a></li>
                          <li><a href="#"><i class="ion-ios-circle-outline"></i> Your own items</a></li>
                        </ul>
                      </div>
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-12">
                            <h2 class="megamenu-title">Featured Posts</h2>
                          </div>
                        </div>
                        <div class="row">
                          <article class="article col-md-4 mini">
                            <div class="inner">
                              <figure>
                                <a href="single.html">
                                  <img src="images/news/img10.jpg" alt="Sample Article">
                                </a>
                              </figure>
                              <div class="padding">
                                <div class="detail">
                                  <div class="time">December 10, 2016</div>
                                  <div class="category"><a href="category.html">Healthy</a></div>
                                </div>
                                <h2><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                              </div>
                            </div>
                          </article>
                          <article class="article col-md-4 mini">
                            <div class="inner">
                              <figure>
                                <a href="single.html">
                                  <img src="images/news/img11.jpg" alt="Sample Article">
                                </a>
                              </figure>
                              <div class="padding">
                                <div class="detail">
                                  <div class="time">December 13, 2016</div>
                                  <div class="category"><a href="category.html">Lifestyle</a></div>
                                </div>
                                <h2><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                              </div>
                            </div>
                          </article>
                          <article class="article col-md-4 mini">
                            <div class="inner">
                              <figure>
                                <a href="single.html">
                                  <img src="images/news/img14.jpg" alt="Sample Article">
                                </a>
                              </figure>
                              <div class="padding">
                                <div class="detail">
                                  <div class="time">December 14, 2016</div>
                                  <div class="category"><a href="category.html">Travel</a></div>
                                </div>
                                <h2><a href="single.html">Duis aute irure dolor in reprehenderit in voluptate</a></h2>
                              </div>
                            </div>
                          </article>
                        </div>
                      </div>
                    </div>                
                  </div>
                </div>
              </li>
              <li class="dropdown magz-dropdown magz-dropdown-megamenu"><a href="#">Column <i class="ion-ios-arrow-right"></i></a>
                <div class="dropdown-menu megamenu">
                  <div class="megamenu-inner">
                    <div class="row">
                      <div class="col-md-3">
                        <h2 class="megamenu-title">Column 1</h2>
                        <ul class="vertical-menu">
                          <li><a href="#">Example 1</a></li>
                          <li><a href="#">Example 2</a></li>
                          <li><a href="#">Example 3</a></li>
                          <li><a href="#">Example 4</a></li>
                          <li><a href="#">Example 5</a></li>
                        </ul>
                      </div>
                      <div class="col-md-3">
                        <h2 class="megamenu-title">Column 2</h2>
                        <ul class="vertical-menu">
                          <li><a href="#">Example 6</a></li>
                          <li><a href="#">Example 7</a></li>
                          <li><a href="#">Example 8</a></li>
                          <li><a href="#">Example 9</a></li>
                          <li><a href="#">Example 10</a></li>
                        </ul>
                      </div>
                      <div class="col-md-3">
                        <h2 class="megamenu-title">Column 3</h2>
                        <ul class="vertical-menu">
                          <li><a href="#">Example 11</a></li>
                          <li><a href="#">Example 12</a></li>
                          <li><a href="#">Example 13</a></li>
                          <li><a href="#">Example 14</a></li>
                          <li><a href="#">Example 15</a></li>
                        </ul>
                      </div>
                      <div class="col-md-3">
                        <h2 class="megamenu-title">Column 4</h2>
                        <ul class="vertical-menu">
                          <li><a href="#">Example 16</a></li>
                          <li><a href="#">Example 17</a></li>
                          <li><a href="#">Example 18</a></li>
                          <li><a href="#">Example 19</a></li>
                          <li><a href="#">Example 20</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="dropdown magz-dropdown"><a href="#">Dropdown Icons <i class="ion-ios-arrow-right"></i></a>
                <ul class="dropdown-menu">
                  <li><a href="#"><i class="icon ion-person"></i> My Account</a></li>
                  <li><a href="#"><i class="icon ion-heart"></i> Favorite</a></li>
                  <li><a href="#"><i class="icon ion-chatbox"></i> Comments</a></li>
                  <li><a href="#"><i class="icon ion-key"></i> Change Password</a></li>
                  <li><a href="#"><i class="icon ion-settings"></i> Settings</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon ion-log-out"></i> Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End nav -->
    </header>

    <section class="page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="questions.php">Questions</a></li>
              <li class="active">Create</li>
            </ol>
            <h1 class="page-title">Create</h1>
            <p class="page-subtitle">Give me your question</p>
            <div class="line thin"></div>
            <div class="page-description">
              <div class="row">
                <div class="col-md-6 col-sm-6">
                  <h3>Question</h3>
                  <p>
                    Your question will be appear on our site later.
                    After being processed and approved by system.
                  </p>
                  <p>
                    Have a nice day!
                  </p>
                </div>
                <div class="col-md-6 col-sm-6">
                  <form class="row contact" id="question-form">
                    <input class="form-control token" name="token" type="hidden" value="<?php echo $_SESSION['user_token'] ?>"></input>
                    <input class="form-control userid" name="userid" type="hidden" value="<?php echo $_SESSION['user_id'] ?>"></input>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Content <span class="required"></span></label>
                        <textarea class="form-control content" name="content" required=""></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="category">Choose a category <span class="required"></span></label>
                        <select class="form-select" name="category" id="category">
                          <?php
                            if (!empty($cates)) { 
                              foreach($cates as $key=>$value){
                          ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                          <?php
                              }
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Tags <span class="required"></span></label>
                        <input class="form-control tags" name="tag" required="" type="text" placeholder="tag1, tag2"></input>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="button" class="btn btn-primary submit">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
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
                      <a href="single.html">
                        <img src="images/news/img12.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="single.html">Donec consequat lorem quis augue pharetra</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="single.html">
                        <img src="images/news/img14.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="single.html">eu dapibus risus aliquam etiam ut venenatis</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="single.html">
                        <img src="images/news/img15.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="single.html">Nulla facilisis odio quis gravida vestibulum </a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="single.html">
                        <img src="images/news/img16.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="single.html">Proin venenatis pellentesque arcu vitae </a></h1>
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
    <script src="js/e-magz.js"></script>
    <script src="js/application.js"></script>
    <script src="js/questions.js"></script>
  </body>
</html>