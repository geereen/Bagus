<?php
//session_start();
if (isset($_POST['login'])) {
  $query = $db->prepare("SELECT * FROM tb_staff WHERE s_username = :username AND s_password = :password AND level = 0");
  $query->execute([
    'username'=>$_POST['username'],
    'password'=>md5($_POST['password']),
  ]);
    if($query->rowCount()>0){ #กรณีมีค่ามากว่า 0 = ล็อกอินผ่าน
    $data = $query->fetch(PDO::FETCH_OBJ);
    $_SESSION['user'] = [
      'username'=>$data->s_username,
      'name'=>$data->fullname_staff,
      'pic'=>$data->pic_staff
    ];
    header('location: apps/home.php');
    }else {
      echo "<script>
        alert('Login Fail!! please check your username and password again.');
      </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <link rel="shortcut icon" href="images/logo/logo.ico" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login Admin</title>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="assets/bootstrap/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="assets/bootstrap/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="assets/bootstrap/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="post">
              <h1> Login </h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="required" name="username"/>
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="required" name="password" />
              </div>
              <div>
                <input type="submit" class="btn btn-default submit" name="login" value="Log in">
                <!-- <a class="btn btn-default submit">Log in</a> -->
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="glyphicon glyphicon-th-large"></i> Admin Bagus</h1>
                  <p>©2016 All Rights Reserved. GeeReen ! is a Admin Bagus. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="#">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="glyphicon glyphicon-th-large"></i> Admin Bagus</h1>
                  <p>©2016 All Rights Reserved. GeeReen ! is a Admin Bagus. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
