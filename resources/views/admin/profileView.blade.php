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
      <h5 class="mb-0">Profile</h5>
      <a href="/logout"><button class="btn btn-outline-primary btn-sm">Logout</button></a>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-cards container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="dashboard-card">
                @foreach($users as $val)
                    <div class="row">
                      <div class="col-6"><h5 class="mb-3">User Profile</h5></div>
                      <div class="col-6"><a href="{{url('/password-view/'.$val->id)}}"><button class="btn btn-sm btn-outline-success" style="float:right;">Change Password</button></a></div>
                    </div>                    
                    <form action="{{url('/user-profile-update/'.$val->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Profile Image</label>
                            <div class="text-center mb-3">
                              <img src="{{asset('/img/uploads/'.$val->photo)}}" 
                                 alt="Profile Image" class="rounded-circle" >
                            </div>
                            <input type="file" class="form-control" id="profileImage" name="photo[]" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" value="{{$val->name}}" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Name</label>
                            <input type="date" class="form-control" value="{{$val->dob}}" id="dob" name="dob" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{$val->email}}" disabled id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control"  value="{{$val->phone}}" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required>{{$val->address}}</textarea>
                        </div>                        
                        <div class="mb-3">
                            <label for="departmentId" class="form-label">Department</label>
                            <select class="form-control" id="departmentId" name="departmentId" required>
                                <option value="" selected disabled>--Select Department--</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" 
                                      @if(isset($val) && $val->departmentId == $department->id) selected @endif>
                                      {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                              @if($val->status == 1)
                                <option value="1" selected>Active</option>
                                <option value="2">Inactive</option>
                                @else
                                <option value="1">Active</option>
                                <option value="2" selected>Inactive</option>
                              @endif
                            </select>
                        </div>
                        <!-- <div class="mb-3">
                          <div class="form-floating mb-3">
                            <input type="oldPassword" class="form-control" name="txtOldPassword" id="oldPassword" placeholder="Password" required />
                            <label for="oldPassword">Old Password</label>
                          </div>
                          <div class="form-floating mb-3">
                            <input type="newPassword" class="form-control" name="txtNewPassword" id="newPassword" placeholder="Password" required />
                            <label for="newPassword">New Password</label>
                          </div>
                        </div> -->
                        <button type="submit" class="btn btn-warning width">Update</button>
                    </form>
                    @endforeach
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
