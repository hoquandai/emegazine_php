<?php
  session_start();
  require_once("api/call.php");
  $cates = json_decode(CallAPI('GET', '/categories'))->data;
  $username = $_SESSION['user_name'] ? $_SESSION['user_name'] : '';
  $cate_groups = json_decode(CallAPI('GET', '/categories/groups'))->data;
  parse_str($_SERVER['QUERY_STRING'], $params);
  $is_update = $params['id'] ? true : false;
  $title = $is_update ? 'Update' : 'Create';
  $question = $params['id'] ? json_decode(CallAPI('GET', '/questions/'.$params['id']))->data : false;
  $q_id = $question ? $question->id : '';
  $q_excerpt = $question ? $question->excerpt : '';
  $q_content = $question ? $question->content : '';
  $q_category = $question ? $question->category->id : '';
  $q_tags = '';
  if ($question) {
    $arr=array();
    foreach($question->tags as $key=>$value) {
      array_push($arr, $value->name);
    }
    $q_tags = implode(",", $arr);
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="eSocial">
    <meta name="author" content="DaiHo">
    <meta name="keyword" content="eSocial">
    <!-- Shareable -->
    <title>eSocial</title>
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
                <a href="index.php">
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
                      
                      if (!empty($cates)) { 
                        foreach($cates as $key=>$value){
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
                  <?php if ($_SESSION['user_admin'] == 'true') { ?>
                  <li><a href="manage_users.php"><i class="icon ion-man"></i>Manage Users</a></li>
                  <li><a href="manage_categories.php"><i class="icon ion-bookmark"></i>Manage Category</a></li>
                  <li><a href="manage_questions.php"><i class="icon ion-document-text"></i>Manage Questions</a></li>
                  <?php } ?>
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
    <section class="page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="questions.php">Questions</a></li>
              <li class="active"><?php echo $title ?></li>
            </ol>
            <h1 class="page-title"><?php echo $title ?></h1>
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
                    <input class="form-control id" name="id" type="hidden" value="<?php echo $q_id ?>"></input>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Excerpt <span class="required"></span></label>
                        <input class="form-control excerpt" name="excerpt" required="" type="text" value="<?php echo $q_excerpt?>"></input>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Content <span class="required"></span></label>
                        <textarea class="form-control content" name="content" required=""><?php echo $q_content?></textarea>
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
                            <?php if ($q_category == $value->id) { ?>
                              <option value="<?php echo $value->id ?>" selected><?php echo $value->name ?></option>
                            <?php } else { ?>
                              <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                            <?php } ?>
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
                        <input class="form-control tags" name="tag" required="" type="text" placeholder="tag1, tag2" value="<?php echo $q_tags?>"></input>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="image">Choose a question picture:</label>
                      <input type="file" class="form-control image" id="image" name="image" accept="image/png, image/jpeg">
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
    <script src="js/questions.js"></script>
  </body>
</html>