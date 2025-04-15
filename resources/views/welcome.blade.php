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
    <div class="topbar">
      <button class="toggle-btn d-md-none" onclick="toggleSidebar()">☰</button>
      <h5 class="mb-0">Dashboard</h5>
      <a href="/logout"><button class="btn btn-outline-primary btn-sm">Logout</button></a>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards container-fluid">
      @include('layouts.message')
      <div class="row g-4">
        <div class="col-md-4">
          <div class="dashboard-card">
            <h6>Total Students</h6>
            <h3>120</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dashboard-card">
            <h6>Active Tasks</h6>
            <h3>45</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="dashboard-card">
            <h6>Attendance Today</h6>
            <h3>95%</h3>
          </div>
        </div>
      </div>

      <div class="mt-5 dashboard-card">
        <h6>Performance Chart</h6>
        <div class="text-center text-muted" style="height: 150px; display: flex; align-items: center; justify-content: center;">
          [Chart Placeholder]
        </div>
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
