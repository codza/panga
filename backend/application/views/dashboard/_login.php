<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Login - <?php// echo $site_name; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo site_url('assets/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo site_url('assets/bootstrap/css/bootstrap-login.css'); ?>" rel="stylesheet">

</head>
<body>
    <div class="container">	
      <form class="form-signin" method="POST" action="<?php echo current_url();?> ">

        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
    </div>
</body>
</html>