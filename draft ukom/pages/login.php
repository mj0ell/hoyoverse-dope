<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Hoyoverse</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="icon" href="../assets/icon/favicon-16x16.png" type="image/x-icon"> 
</head>
<body>

  <div class="overlay"></div>


  <div class="login-container">
    <div class="card">
      <h2 class="text-center">Login</h2>

      <form action="../config/proseslogin.php" method="post">
        <div class="input-group">
          <span class="input-icon"><i class="fas fa-user"></i></span>
          <input type="text" class="form-input" id="username" name="username" placeholder="Username" required>
        </div>
        
        <div class="input-group">
          <span class="input-icon"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-input" id="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit" class="btn-login">Login</button>
      </form>
</body>
</html>
