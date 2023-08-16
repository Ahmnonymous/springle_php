<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="jquery-ui.css">
  <link rel="stylesheet" href="includes/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: #f5f4f4;">

  <div class="container mt-4">
    <div class="container mt-4">
  <section>
    <h2 class="title text-center">Sing Up</h2>
    <form method="POST" action="includes/auth.php" class="custom-form  mx-auto mb-5 contact-form bg-white p-5 shadow">
      <div class="form-field col-lg-6 col-sm-12 mx-auto" style="margin:40px">
          <input id="name" name="name" class="input-text js-input form-control shadow-none rounded-0" type="text" required>
          <label class="label" for="name">User Name</label>
        </div>
        
        <div class="form-field col-lg-6 col-sm-12 mx-auto" style="margin:40px">
          <input id="email" name="email" class="input-text js-input form-control shadow-none rounded-0" type="email" required>
          <label class="label" for="email">Email</label>
        </div>
        <div class="form-field col-lg-6  col-sm-12 mx-auto" style="margin:50px">
          <input id="password" type="password" name="password" class="input-text js-input form-control shadow-none rounded-0"required>
          <label class="label" for="password">Password</label>
        </div>
        
          <div class="form-field col-lg-6  col-sm-12 mx-auto" style="margin:50px">
          <input id="cpassword" type="password" name="cpassword" class="input-text js-input form-control shadow-none rounded-0"required>
          <label class="label" for="cpassword">Confirm Password</label>
        </div>
      
      <div class="form-field col-sm-12 text-center">
        <input class="submit-btn btn btn-primary" type="submit" value="Sign Up">
        or
        <a href="index.php">Already have an account?</a>
      </div>
    </form>
  </section>
</div>

  </div>
  <script src="jquery.js"></script>
  <script src="jquery-ui.js"></script>
  <script>
    $('.js-input').keyup(function() {
      if ($(this).val()) {
        $(this).addClass('not-empty');
      } else {
        $(this).removeClass('not-empty');
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>