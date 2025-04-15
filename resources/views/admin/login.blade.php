<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Student Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(to right, #4f46e5, #3b82f6);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      background: #fff;
      border-radius: 10px;
      padding: 2rem;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .login-card h2 {
      font-weight: bold;
      color: #4f46e5;
    }
    .form-control:focus, .form-select:focus {
      box-shadow: none;
      border-color: #4f46e5;
    }
    .btn-primary {
      background-color: #4f46e5;
      border: none;
    }
    .btn-primary:hover {
      background-color: #4338ca;
    }
  </style>
</head>
<body>

  <div class="login-card text-center">
  @include('layouts.message')
    <h2 class="mb-4">Login</h2>
    <form action="/user-login" method="GET">
        <!-- Email -->
        <div class="form-floating mb-3">
            <input type="email" class="form-control" name="txtEmail" value="samim@gmail.com" id="email" placeholder="name@example.com" required>
            <label for="email">Email address</label>
        </div>
        
        <!-- Password -->
        <div class="form-floating mb-4">
            <input type="password" class="form-control" name="txtPassword" value="123456" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>

        <!-- Role Selection -->
      <div class="form-floating mb-3">
        <select class="form-select" name="cbxRole" id="role" required>
          <option value="" selected disabled>Select Role</option>
          <option value="3">Headmaster</option>
          <option value="2">Teacher</option>
          <option value="1">Student</option>
        </select>
        <label for="role">Login as</label>
      </div>

      <button class="btn btn-primary w-100 mb-3" type="submit">Login</button>
      <small class="text-muted">Create new account - <a href="/signin-view">Click here</a></small>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
