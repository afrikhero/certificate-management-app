<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login Page</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="image/favicon.ico" />
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="login-panel panel panel-success">
            <div class="panel-heading">
              <h3 class="panel-title">Login to Manage Certificate Records</h3>
            </div>
            <div class="panel-body">
              <form role="form" method="post" action="verify.php">
                <fieldset>
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Username" name="username"  autofocus required />
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="password" name="password" value="" required/>
                  </div>
                  <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="login" />
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
