<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create User - Student Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background:rgb(208, 208, 208);
      padding-top: 50px;
    }
    .form-container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }
    .form-title {
      color: #4f46e5;
      font-weight: bold;
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

@include('layouts.message')

  <div class="container">
    <div class="form-container">
      <h2 class="form-title mb-4 text-center">Create New User</h2>
      <form action="/create-user" method="GET">
        @csrf
        <!-- Name -->
        <div class="form-floating mb-3">
          <input type="text" class="form-control" name="txtName" id="name" placeholder="Full Name" required />
          <label for="name">Full Name</label>
        </div>

        <!-- Email -->
        <div class="form-floating mb-3">
          <input type="email" class="form-control" name="txtEmail" id="email" placeholder="Email" required />
          <label for="email">Email Address</label>
        </div>

        <!-- Password -->
        <div class="form-floating mb-3">
          <input type="password" class="form-control" name="txtPassword" id="password" placeholder="Password" required />
          <label for="password">Password</label>
        </div>

        <!-- Role -->
        <div class="form-floating mb-4">
          <select class="form-select" name="cbxRole" id="role" required>
            <option selected disabled value="">Select Role</option>
            <option value="3">Headmaster</option>
            <option value="2">Teacher</option>
            <option value="1">Student</option>
          </select>
          <label for="role">Role</label>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary w-100">Create User</button>
        <small class="text-muted">User login - <a href="/login-view">Click here</a></small>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
