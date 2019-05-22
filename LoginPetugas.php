<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>APP SPP | MA NW KOTARAJA</title>
  <?php include "css.php"; ?>
</head>

<body class="body-Login-back">

  <div class="container">

    <div class="row">
      <div class="col-md-4 col-md-offset-4 text-center logo-margin ">
        <h4 style="color: white; font-size: 30px; margin-top: 0;"><strong>Selamat Datang</strong></h4>
      </div>
      <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">                  
          <div class="panel-heading">
            <h3 class="panel-title">Silahkan Masuk</h3>
          </div>
          <div class="panel-body">
            <p class="hide-text">
              <?php
              session_start();
              if ($_SESSION['Pesan']) {
                ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $_SESSION['Pesan'] ?>
                </div>
                <?php
              }
              $_SESSION['Pesan'] = "";
              ?>
            </p>
            <form role="form" action="ProsesLogin.php" method="POST" onclick="return validateForm()">
              <fieldset>
                <div class="form-group">
                  <input class="form-control" placeholder="Username" name="username" type="text" autofocus required>
                </div>
                <div class="form-group">
                  <input class="form-control" placeholder="Password" name="password" type="password" required>
                </div>
                <div class="checkbox">
                  <label>
                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                  </label>
                </div>
                <!-- Change this to a button or input when using this as a form -->
                <button type="submit" class="btn btn-success btn-lg btn-block">
                 <i class="fa fa-sign-in"></i> Masuk
               </button>
             </fieldset>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>

 <!-- Core Scripts - Include with every page -->
 <script src="assets/plugins/jquery-1.10.2.js"></script>
 <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
 <script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>

</body>

</html>
