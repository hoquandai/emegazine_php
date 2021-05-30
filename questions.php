<?php
  session_start();
  require_once("api/call.php");
  $authenticated_data = $_SESSION['loggedin'] ? array("authenticated" => true) : array();
  parse_str($_SERVER['QUERY_STRING'], $params);
  $payload = array_merge($authenticated_data, array("tag" => $params['tag']));
  $cates = CallAPI('GET', '/categories');
  $latest_data = json_decode(CallAPI('GET', '/questions/tag', $_SESSION['loggedin'], $payload))->data;
  $latest_questions = $latest_data->questions;
  $latest_likes = $latest_data->likes;
  $username = $_SESSION['user_name'] ? $_SESSION['user_name'] : ''
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
                      <li><a href="#<?php echo $key ?>"><?php echo $value->name ?></a></li>
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
              <li class="dropdown magz-dropdown"><a href="#">Profile <i class="ion-ios-arrow-right"></i></a>
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

    <section class="home">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-12 col-xs-12">
            <div class="headline">
              <div class="nav" id="headline-nav">
                <a class="left carousel-control" role="button" data-slide="prev">
                  <span class="ion-ios-arrow-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" role="button" data-slide="next">
                  <span class="ion-ios-arrow-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
              <div class="owl-carousel owl-theme" id="headline">              
                <div class="item">
                  <a href="#"><div class="badge">Tip!</div> Vestibulum ante ipsum primis in faucibus orci</a>
                </div>
                <div class="item">
                  <a href="#">Ut rutrum sodales mauris ut suscipit</a>
                </div>
              </div>
            </div>
            <div class="owl-carousel owl-theme slide" id="featured">
              <div class="item">
                <article class="featured">
                  <div class="overlay"></div>
                  <figure>
                    <img src="images/news/img04.jpg" alt="Sample Article">
                  </figure>
                  <div class="details">
                    <div class="category"><a href="category.html">Computer</a></div>
                    <h1><a href="question.php">Phasellus iaculis quam sed est elementum vel ornare ligula venenatis</a></h1>
                    <div class="time">December 26, 2016</div>
                  </div>
                </article>
              </div>
              <div class="item">
                <article class="featured">
                  <div class="overlay"></div>
                  <figure>
                    <img src="images/news/img14.jpg" alt="Sample Article">
                  </figure>
                  <div class="details">
                    <div class="category"><a href="category.html">Travel</a></div>
                    <h1><a href="question.php">Class aptent taciti sociosqu ad litora torquent per conubia nostra</a></h1>
                    <div class="time">December 10, 2016</div>
                  </div>
                </article>
              </div>
              <div class="item">
                <article class="featured">
                  <div class="overlay"></div>
                  <figure>
                    <img src="images/news/img13.jpg" alt="Sample Article">
                  </figure>
                  <div class="details">
                    <div class="category"><a href="category.html">International</a></div>
                    <h1><a href="question.php">Maecenas accumsan tortor ut velit pharetra mollis</a></h1>
                    <div class="time">October 12, 2016</div>
                  </div>
                </article>
              </div>
              <div class="item">
                <article class="featured">
                  <div class="overlay"></div>
                  <figure>
                    <img src="images/news/img05.jpg" alt="Sample Article">
                  </figure>
                  <div class="details">
                    <div class="category"><a href="category.html">Lifestyle</a></div>
                    <h1><a href="question.php">Mauris elementum libero at pharetra auctor Fusce ullamcorper elit</a></h1>
                    <div class="time">November 27, 2016</div>
                  </div>
                </article>
              </div>
            </div>
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
                            <img src="images/news/img10.jpg" alt="Sample Article">
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
            <aside>
              <div class="aside-body">
                <div class="featured-author">
                  <div class="featured-author-inner">
                    <div class="featured-author-cover" style="background-image: url('images/news/img15.jpg');">
                      <div class="badges">
                        <div class="badge-item"><i class="ion-star"></i> Featured</div>
                      </div>
                      <div class="featured-author-center">
                        <figure class="featured-author-picture">
                          <img src="images/img01.jpg" alt="Sample Article">
                        </figure>
                        <div class="featured-author-info">
                          <h2 class="name">John Doe</h2>
                          <div class="desc">@JohnDoe</div>
                        </div>
                      </div>
                    </div>
                    <div class="featured-author-body">
                      <div class="featured-author-count">
                        <div class="item">
                          <a href="#">
                            <div class="name">Posts</div>
                            <div class="value">208</div>                            
                          </a>
                        </div>
                        <div class="item">
                          <a href="#">
                            <div class="name">Stars</div>
                            <div class="value">3,729</div>                            
                          </a>
                        </div>
                        <div class="item">
                          <a href="#">
                            <div class="icon">
                              <div>More</div>
                              <i class="ion-chevron-right"></i>
                            </div>                            
                          </a>
                        </div>
                      </div>
                      <div class="featured-author-quote">
                        "Eur costrict mobsa undivani krusvuw blos andugus pu aklosah"
                      </div>
                      <div class="block">
                        <h2 class="block-title">Photos</h2>
                        <div class="block-body">
                          <ul class="item-list-round" data-magnific="gallery">
                            <li><a href="images/news/img06.jpg" style="background-image: url('images/news/img06.jpg');"></a></li>
                            <li><a href="images/news/img07.jpg" style="background-image: url('images/news/img07.jpg');"></a></li>
                            <li><a href="images/news/img08.jpg" style="background-image: url('images/news/img08.jpg');"></a></li>
                            <li><a href="images/news/img09.jpg" style="background-image: url('images/news/img09.jpg');"></a></li>
                            <li><a href="images/news/img10.jpg" style="background-image: url('images/news/img10.jpg');"></a></li>
                            <li><a href="images/news/img11.jpg" style="background-image: url('images/news/img11.jpg');"></a></li>
                            <li><a href="images/news/img12.jpg" style="background-image: url('images/news/img12.jpg');"><div class="more">+2</div></a></li>
                            <li class="hidden"><a href="images/news/img13.jpg" style="background-image: url('images/news/img13.jpg');"></a></li>
                            <li class="hidden"><a href="images/news/img14.jpg" style="background-image: url('images/news/img14.jpg');"></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="featured-author-footer">
                        <a href="#">See All Authors</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
            <aside>
              <h1 class="aside-title">Popular <a href="#" class="all">See All <i class="ion-ios-arrow-right"></i></a></h1>
              <div class="aside-body">
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img07.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
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
                      <h1><a href="question.php">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img09.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Aliquam et metus convallis tincidunt velit ut rhoncus dolor</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img11.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">dui augue facilisis lacus fringilla pulvinar massa felis quis velit</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img06.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">neque est semper nulla, ac elementum risus quam a enim</a></h1>
                    </div>
                  </div>
                </article>
                <article class="article-mini">
                  <div class="inner">
                    <figure>
                      <a href="question.php">
                        <img src="images/news/img03.jpg" alt="Sample Article">
                      </a>
                    </figure>
                    <div class="padding">
                      <h1><a href="question.php">Morbi vitae nisl ac mi luctus aliquet a vitae libero</a></h1>
                    </div>
                  </div>
                </article>
              </div>
            </aside>
            <aside>
              <div class="aside-body">
                <form class="newsletter">
                  <div class="icon">
                    <i class="ion-ios-email-outline"></i>
                    <h1>Newsletter</h1>
                  </div>
                  <div class="input-group">
                    <input type="email" class="form-control email" placeholder="Your mail">
                    <div class="input-group-btn">
                      <button class="btn btn-primary"><i class="ion-paper-airplane"></i></button>
                    </div>
                  </div>
                  <p>By subscribing you will receive new articles in your email.</p>
                </form>
              </div>
            </aside>
            <aside>
              <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="active">
                  <a href="#recomended" aria-controls="recomended" role="tab" data-toggle="tab">
                    <i class="ion-android-star-outline"></i> Recomended
                  </a>
                </li>
                <li>
                  <a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">
                    <i class="ion-ios-chatboxes-outline"></i> Comments
                  </a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="recomended">
                  <article class="article-fw">
                    <div class="inner">
                      <figure>
                        <a href="question.php">
                          <img src="images/news/img16.jpg" alt="Sample Article">
                        </a>
                      </figure>
                      <div class="details">
                        <div class="detail">
                          <div class="time">December 31, 2016</div>
                          <div class="category"><a href="category.html">Sport</a></div>
                        </div>
                        <h1><a href="question.php">Donec congue turpis vitae mauris</a></h1>
                        <p>
                          Donec congue turpis vitae mauris condimentum luctus. Ut dictum neque at egestas convallis. 
                        </p>
                      </div>
                    </div>
                  </article>
                  <div class="line"></div>
                  <article class="article-mini">
                    <div class="inner">
                      <figure>
                        <a href="question.php">
                          <img src="images/news/img05.jpg" alt="Sample Article">
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
                          <img src="images/news/img02.jpg" alt="Sample Article">
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
                          <img src="images/news/img10.jpg" alt="Sample Article">
                        </a>
                      </figure>
                      <div class="padding">
                        <h1><a href="question.php">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                        <div class="detail">
                          <div class="category"><a href="category.html">Healthy</a></div>
                          <div class="time">December 20, 2016</div>
                        </div>
                      </div>
                    </div>
                  </article>
                </div>
                <div class="tab-pane comments" id="comments">
                  <div class="comment-list sm">
                    <div class="item">
                      <div class="user">                                
                        <figure>
                          <img src="images/img01.jpg" alt="User Picture">
                        </figure>
                        <div class="details">
                          <h5 class="name">Mark Otto</h5>
                          <div class="time">24 Hours</div>
                          <div class="description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="user">                                
                        <figure>
                          <img src="images/img01.jpg" alt="User Picture">
                        </figure>
                        <div class="details">
                          <h5 class="name">Mark Otto</h5>
                          <div class="time">24 Hours</div>
                          <div class="description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="user">                                
                        <figure>
                          <img src="images/img01.jpg" alt="User Picture">
                        </figure>
                        <div class="details">
                          <h5 class="name">Mark Otto</h5>
                          <div class="time">24 Hours</div>
                          <div class="description">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </aside>
            <aside>
              <h1 class="aside-title">Videos
                <div class="carousel-nav" id="video-list-nav">
                  <div class="prev"><i class="ion-ios-arrow-left"></i></div>
                  <div class="next"><i class="ion-ios-arrow-right"></i></div>
                </div>
              </h1>
              <div class="aside-body">
                <ul class="video-list" data-youtube='"carousel":true, "nav": "#video-list-nav"'>
                  <li><a data-youtube-id="SBjQ9tuuTJQ" data-action="magnific"></a></li>
                  <li><a data-youtube-id="9cVJr3eQfXc" data-action="magnific"></a></li>
                  <li><a data-youtube-id="DnGdoEa1tPg" data-action="magnific"></a></li>
                </ul>
              </div>
            </aside>
            <aside id="sponsored">
              <h1 class="aside-title">Sponsored</h1>
              <div class="aside-body">
                <ul class="sponsored">
                  <li>
                    <a href="#">
                      <img src="images/sponsored.png" alt="Sponsored">
                    </a>
                  </li> 
                  <li>
                    <a href="#">
                      <img src="images/sponsored.png" alt="Sponsored">
                    </a>
                  </li> 
                  <li>
                    <a href="#">
                      <img src="images/sponsored.png" alt="Sponsored">
                    </a>
                  </li> 
                  <li>
                    <a href="#">
                      <img src="images/sponsored.png" alt="Sponsored">
                    </a>
                  </li> 
                </ul>
              </div>
            </aside>
          </div>
        </div>
      </div>
    </section>

    <section class="best-of-the-week">
      <div class="container">
        <h1><div class="text">Best Of The Week</div>
          <div class="carousel-nav" id="best-of-the-week-nav">
            <div class="prev">
              <i class="ion-ios-arrow-left"></i>
            </div>
            <div class="next">
              <i class="ion-ios-arrow-right"></i>
            </div>
          </div>
        </h1>
        <div class="owl-carousel owl-theme carousel-1">
          <article class="article">
            <div class="inner">
              <figure>
                <a href="question.php">
                  <img src="images/news/img03.jpg" alt="Sample Article">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                    <div class="time">December 11, 2016</div>
                    <div class="category"><a href="category.html">Travel</a></div>
                </div>
                <h2><a href="question.php">tempor interdum Praesent tincidunt</a></h2>
                <p>Praesent tincidunt, leo vitae congue molestie.</p>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="inner">
              <figure>
                <a href="question.php">
                  <img src="images/news/img16.jpg" alt="Sample Article">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                  <div class="time">December 09, 2016</div>
                  <div class="category"><a href="category.html">Sport</a></div>
                </div>
                <h2><a href="question.php">Maecenas porttitor sit amet turpis a semper</a></h2>
                <p> Proin vulputate, urna id porttitor luctus, dui augue facilisis lacus.</p>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="inner">
              <figure>
                <a href="question.php">
                  <img src="images/news/img15.jpg" alt="Sample Article">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                  <div class="time">December 26, 2016</div>
                  <div class="category"><a href="category.html">Lifestyle</a></div>
                </div>
                <h2><a href="question.php">Fusce ac odio eu ex volutpat pellentesque</a></h2>
                <p>Vestibulum ante ipsum primis in faucibus orci luctus</p>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="inner">
              <figure>
                <a href="question.php">
                  <img src="images/news/img14.jpg" alt="Sample Article">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                  <div class="time">December 26, 2016</div>
                  <div class="category"><a href="category.html">Travel</a></div>
                </div>
                <h2><a href="question.php">Nulla facilisis odio quis gravida vestibulum</a></h2>
                <p>Proin venenatis pellentesque arcu, ut mattis nulla placerat et.</p>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="inner">
              <figure>
                <a href="question.php">
                  <img src="images/news/img01.jpg" alt="Sample Article">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                  <div class="time">December 26, 2016</div>
                  <div class="category"><a href="category.html">Travel</a></div>
                </div>
                <h2><a href="question.php">Fusce Ullamcorper Elit At Felis Cursus Suscipit</a></h2>
                <p>Proin venenatis pellentesque arcu, ut mattis nulla placerat et.</p>
              </div>
            </div>
          </article>
          <article class="article">
            <div class="inner">
              <figure>
                <a href="question.php">
                  <img src="images/news/img11.jpg" alt="Sample Article">
                </a>
              </figure>
              <div class="padding">
                <div class="detail">
                  <div class="time">December 26, 2016</div>
                  <div class="category"><a href="category.html">Travel</a></div>
                </div>
                <h2><a href="question.php">Donec consequat arcu at ultrices sodales</a></h2>
                <p>Proin venenatis pellentesque arcu, ut mattis nulla placerat et.</p>
              </div>
            </div>
          </article>
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
    <script src="js/e-magz.js"></script>
  </body>
</html>