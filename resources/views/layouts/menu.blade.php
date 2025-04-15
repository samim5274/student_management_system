<div class="sidebar" id="sidebar">
    <h4>EduManage</h4>
    <ul>
      <li><a href="/admin/dashboard">Dashboard</a></li>
      <li><a href="/student-view">Students</a></li>
      <li><a href="/teacher-view">Teachers</a></li>
      <li><a href="/task-view">Tasks</a></li>
      <li><a href="/announcement-view">Announcement</a></li>
      <li><a href="/profile-view">Profile - {{Auth::guard('admin')->user()->name}}</a></li>
      <li><a href="#">Setting</a></li>
    </ul>
  </div>

  <!-- Overlay for mobile -->
  <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>