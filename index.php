<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="js/jquery-ui.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.css">
  
</head>

<body>

  <div class="container">
    <section>
      <form method="POST" action="login_sql.php" class="custom-form mx-auto mb-5 contact-form shadow">
      <h2 class="title text-center">Springle - Login</h2>
        <div class="form-field col-sm-12 mx-auto">
          <input id="email" name="email" placeholder="Email Address" class="input-text js-input form-control shadow-none rounded-0" type="email"
            required>
        </div>
        <div class="form-field col-sm-12 mx-auto">
          <input id="password" name="password" placeholder="Password" class="input-text js-input form-control shadow-none rounded-0"
            type="password" required>
        </div>
        <div class="form-field col-sm-12 text-center">
          <input class="submit-btn btn btn-primary" type="submit" value="Login">
        </div>
      </form>
    </section>
  </div>

  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</body>

</html>
