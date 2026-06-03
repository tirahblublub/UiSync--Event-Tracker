<?php

$host = 'localhost';
$db   = 'uisync_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$error_message = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        try {
            
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user_record = $stmt->fetch();

            
            if ($user_record && password_verify($password, $user_record['password'])) {
                
                header("Location: dashboard.php");
                exit;
            } else {
                $error_message = "Invalid email or password!";
            }
        } catch (PDOException $e) {
            
            $error_message = "Database connection error!";
        }
    } else {
        $error_message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - UiSync</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
    body {
      height: 100vh; display: flex; justify-content: center; align-items: center; overflow: hidden; color: white;
      background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.9)), url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d'); 
      background-size: cover; background-position: center; background-repeat: no-repeat;
    }
    .login-box {
      width: 360px; padding: 40px; border-radius: 15px; background: rgba(0, 0, 0, 0.6);
      border: 1px solid rgba(255, 193, 7, 0.3); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); backdrop-filter: blur(10px);
    }
    .login-box h3 { text-align: center; margin-bottom: 25px; color: #ffc107; font-weight: bold; }
    label { margin-bottom: 5px; color: #f1f1f1; font-size: 14px; }
    .form-control { background: rgba(255, 255, 255, 0.08); border: 1px solid rgba(255, 193, 7, 0.3); color: white; }
    .form-control:focus { background: rgba(255, 255, 255, 0.12); border-color: #ffc107; box-shadow: none; color: white; }
    .btn-custom { background: #ffc107; color: black; font-weight: bold; border: none; transition: 0.3s; }
    .btn-custom:hover { background: #e0a800; color: black; transform: scale(1.02); }
    .error-feedback {
      display: <?= !empty($error_message) ? 'block' : 'none' ?>;
      font-size: 13px; border-radius: 8px; padding: 10px; margin-bottom: 15px;
      background: rgba(220, 53, 69, 0.2); color: #ea868f; border: 1px solid rgba(220, 53, 69, 0.4);
    }
  </style>
</head>
<body>

<div class="login-box">
  <h3>WELCOME TO UISYNC</h3>

  <div id="errorFeedback" class="error-feedback">
    <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= htmlspecialchars($error_message) ?>
  </div>

  <form action="login.php" method="POST">
    <div class="mb-3">
      <label for="email">Email Address</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
    </div>

    <div class="mb-3">
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required>
    </div>

    <button type="submit" class="btn btn-custom w-100 py-2 mt-2">
      Login <i class="bi bi-box-arrow-in-right ms-1"></i>
    </button>
  </form>
</div>

</body>
</html>