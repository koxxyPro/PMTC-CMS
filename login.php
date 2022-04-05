<?php
include_once'db/connect_db.php';
session_start();
if(isset($_POST['btn_login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = $pdo->prepare("select * from tbl_user where username='$username' AND password='$password' ");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if($row['username']==$username AND $row['password']==$password AND $row['role']=="Admin" AND $row['is_active']=="1"){
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['fullname']=$row['fullname'];
        $_SESSION['role']=$row['role'];

        $message = 'success';
        header('refresh:2;dashboard.php');

    }else if($row['username']==$username AND $row['password']==$password AND $row['role']=="Operator" AND $row['is_active']=="1"){
        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['fullname']=$row['fullname'];
        $_SESSION['role']=$row['role'];
        $message = 'success';
        header('refresh:2;dashboard.php');
    }else {
        $errormsg = 'error';
    }
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Avatecial POS | Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <link rel="shortcut icon" href="img/duka.png">

    <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="plugins/iCheck/icheck.min.js"></script>
  <!--Sweetalert Plugin --->
  <script src="bower_components/sweetalert/sweetalert.js"></script>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b>Avatecial POS</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Please Enter Your Credentials</p>

    <form action="" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
            <button type="submit" class="text-muted text-center btn-block btn btn-primary btn-rect" name="btn_login">Log In</button>
        </div>
      </div>

      <!--footer-->
      <footer style="margin-top: 10px">
        <p class="login-box-msg">Copyright &copy; 2022. All rights reserved</p>
      </footer>
      <?php
        if(!empty($message)){
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Login Success", "Welcome '.$_SESSION['role'].'", "success", {
              button: "Continue",
                });
              });
              </script>';
            }else{}
        if(empty($errormsg)){
        }else{
          echo'<script type="text/javascript">
              jQuery(function validation(){
              swal("Login Fail", "Username or Password is Wrong!", "error", {
              button: "Continue",
                });
              });
          </script>';
        }
      ?>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>


<!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script></body>
</html>
