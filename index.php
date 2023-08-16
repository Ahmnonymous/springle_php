<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="jquery-ui.css">
  <!--link rel="stylesheet" href="includes/style.css"-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.css">
  <style>
    body {
      background-color: #f5f4f4;
    }

    .container {
      margin-top: 4rem;
    }

    .custom-form {
      max-width: 400px;
      margin: 0 auto;
      padding: 2rem;
      background-color: white;
      border-radius: 5px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .input-text {
      width: 100%;
      padding: 0.5rem;
      border: none;
      border-bottom: 1px solid #ccc;
      font-size: 16px;
    }

    .label {
      position: absolute;
      top: 0.75rem;
      left: 1rem;
      font-size: 16px;
      color: #666;
      pointer-events: none;
      transition: 0.2s all;
    }

    .input-text:focus ~ .label,
    .input-text.not-empty ~ .label {
      top: -1rem;
      font-size: 12px;
      color: #007bff;
    }

    .submit-btn {
      width: 100%;
      padding: 0.75rem;
      background-color: #007bff;
      border: none;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .submit-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>

<body>

  <div class="container">
    <section>
      <h2 class="title text-center">Login</h2>
      <form method="POST" action="includes/login_auth.php" class="custom-form mx-auto mb-5 contact-form shadow">
        <div class="form-field col-sm-12 mx-auto">
          <input id="email" name="email" class="input-text js-input form-control shadow-none rounded-0" type="email"
            required>
          <label class="label" for="email">Email</label>
        </div>
        <div class="form-field col-sm-12 mx-auto">
          <input id="password" name="password" class="input-text js-input form-control shadow-none rounded-0"
            type="password" required>
          <label class="label" for="password">Password</label>
        </div>
        <div class="form-field col-sm-12 text-center">
          <input class="submit-btn btn btn-primary" type="submit" value="Login">
        </div>
      </form>
    </section>
  </div>

  <script src="jquery.js"></script>
  <script src="jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</body>

</html>
