<?php
session_start();
?>

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
    <?php
    if (isset($_SESSION['success_message'])) {
      $message = $_SESSION['success_message'];
      echo "<script>
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '$message',
        customClass: {
          confirmButton: 'bg-success shadow-none',
      }
          })
            </script>";
      unset($_SESSION['success_message']);
    }
    ?>
    <div class="container mt-4">
      <section>
        <h2 class="title text-center">Login</h2>
        <form method="POST" action="includes/login_auth.php" class="custom-form mx-auto mb-5 contact-form bg-white p-5 shadow">
          <div class="form-field col-sm-4 mx-auto">
            <input id="email" name="email" class="input-text js-input form-control shadow-none rounded-0" type="email" required>
            <label class="label" for="email">Email</label>
          </div>
          <div class="form-field col-sm-4 mx-auto">
            <input id="password" name="password" class="input-text js-input form-control shadow-none rounded-0" type="password" required>
            <label class="label" for="password">Password</label>
          </div>
          <div class="form-field col-sm-12 text-center">
            <input class="submit-btn btn btn-primary" type="submit" value="Login">
          </div>
        </form>
      </section>
    </div>

  </div>
  <script src="jquery.js"></script>
  <script src="jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>