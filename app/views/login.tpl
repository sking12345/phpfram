<!DOCTYPE html>
<html>
<head>
  <meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?=snow\config::$obj->app->get("title")?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/components/Ionicons/css/ionicons.min.css">
   <link rel="stylesheet" href="public/cus-icons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/css/AdminLTE.min.css">

  <!-- iCheck -->
  <link rel="stylesheet" href="public/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><?=snow\config::$obj->app->get("title")?></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg" style="color: red"><?=snow\tpl::get_assign("err_info")?></p>
      
    <form action="" method="post">
       <?=snow\tpl::from_token()?>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="username">
        <span class="cue cue-github form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <label style="font-weight: 100;"><input type="checkbox"> Remember Me</label>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="public/components/jquery/dist/jquery.min.js"></script>
<script src="public/components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="public/js/template-web.js"></script>
<script type="text/javascript" src="public/js/main.js"></script>
<script>
    $(document).ready(function() {
        rendering('msg', true);
    });
</script>
</body>
</html>
