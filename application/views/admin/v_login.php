<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->

    <title>Admin LOGIN</title>
  
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../../assets/css/floating-labels.css" rel="stylesheet">
  </head>

  <body>
    <form class="form-signin" action="<?php echo base_url('admin/c_admin/authenticate')?>" method="post">
      <div class="text-center mb-4">
        <img class="mb-4" src="../../assets/images/logo.png" alt="" width="200">
        <h1 class="h3 mb-3 font-weight-normal">LOGIN</h1>
      </div>

      <div class="form-label-group">
        <input type="text" id="inputEmail"  name="username" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Username</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword"  name="password" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2019</p>
    </form>
  </body>
</html>
