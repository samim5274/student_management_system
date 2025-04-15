<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Management Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
    }

    .width{
      width: 100%;
    }

    img{
      width: 150px; 
      height: 150px; 
      object-fit: cover; 
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.9);
    }

    .wrapper {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: #fff;
      flex-shrink: 0;
      transition: transform 0.3s ease;
    }

    .sidebar h4 {
      padding: 1rem;
      text-align: center;
      background-color: #23272b;
      margin-bottom: 0;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar ul li a {
      display: block;
      padding: 12px 20px;
      color: #adb5bd;
      text-decoration: none;
      transition: background-color 0.2s ease;
    }

    .sidebar ul li a:hover {
      background-color: #495057;
      color: #fff;
    }

    .content {
      flex-grow: 1;
    }

    .topbar {
      background-color: #fff;
      padding: 1rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .dashboard-cards {
      padding: 2rem;
    }

    .dashboard-card {
      border-radius: 0.5rem;
      padding: 1.5rem;
      background: #fff;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .toggle-btn {
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #343a40;
    }

    /* Mobile responsive sidebar */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        height: 100%;
        top: 0;
        left: 0;
        transform: translateX(-100%);
        z-index: 1000;
      }

      .sidebar.show {
        transform: translateX(0);
      }

      .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
      }

      .overlay.show {
        display: block;
      }
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Sidebar -->
  @include('layouts.menu')

  <!-- Main Content -->
  <div class="content">
    <!-- Top Navbar -->
    @include('layouts.message')
    <div class="topbar">
      <button class="toggle-btn d-md-none" onclick="toggleSidebar()">☰</button>
      <h5 class="mb-0">Change Password</h5>
      <a href="/logout"><button class="btn btn-outline-primary btn-sm">Logout</button></a>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-card"> @foreach($users as $val)
                    <form action="{{url('/password-update/'.$val->id)}}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="txtOldPassword" id="oldPassword" placeholder="Password" required />
                            <label for="oldPassword">Old Password</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="password" class="form-control" name="txtNewPassword" id="newPassword" placeholder="Password" required />
                            <label for="newPassword">New Password</label>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-warning width">Changed</button>
                    </form>
                </div>@endforeach
            </div>
        </div>
  </div>
</div>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Sidebar Toggle Script -->
<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('overlay').classList.toggle('show');
  }
</script>

</body>
</html>
