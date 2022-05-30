<?php  
include './libs/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMS Portal</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-danger">
      <div class="card-header text-center">
        <div>
         <img class="" src="./dist/img/matlogo.png" alt="MatlifeLogo" height="60" width="60">
        </div>
        <a href="./index.php" class="h2">Metlife Call Center SMS Portal</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="userName"  placeholder="User Name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" id="password" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <!-- <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label> -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="button" class="btn btn-primary btn-block" onclick="userLogin()">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="plugins/toastr/toastr.min.js"></script>
</body>
</html>
<script type="text/javascript">
  function sweetAlert(title, type) {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });
    Toast.fire({
      icon: type,
      title: title
    })
  };


  function userLogin() {
    const userName=$("#userName").val();
    const password=$("#password").val();
    var flag = 1;
    var check = "userLogin";
    if (userName == "") {
      $("#userName").css({ "border": "1px solid red" });
      flag = 0;
    }
    if (password == "") {
      $("#password").css({ "border": "1px solid red" });
      flag = 0;
    }
    if (flag==1) {
      $.ajax({
        url: "reports/userAction.php",
        type: "POST",
        data: {
          userName: userName,
          password: password,
          check:check
        },
        success: function (response) {
         if (response == 'success') {
          window.location.replace("./home.php");
         }
         else {
          sweetAlert(response, "error");
        }
      }
    });
    }
  }
</script>