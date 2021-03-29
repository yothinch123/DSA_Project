<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="margin-top: 70px;">
  <hr class="sidebar-divider my-0">

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Features
  </div>
  <li class="nav-item active">
    <a class="nav-link" onclick="window.location.href='/CPE/BaseController/view_dashboard'" style="color: #222831;">
      <i class="fas fa-home"></i>
      <span>หน้าหลัก</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/BaseController/view_wifi_setting'" style="color: #222831;">
      <i class="fas fa-edit"></i>
      <span>จัดการการใช้งานไวฟาย</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/BaseController/view_statistics'" style="color: #222831;">
      <i class="fas fa-edit"></i>
      <span>จัดการสถิติข้อมูล</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/BaseController/view_employee'" style="color: #222831;">
      <i class="fas fa-edit"></i>
      <span>จัดการผู้ใช้งานระบบ</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    USER
  </div>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/BaseController/view_user'" style="color: #222831;">
      <i class="fas fa-edit"></i>
      <span>จัดการข้อมูลส่วนตัว</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="_logout()" style="color: #222831;">
      <i class="fas fa-sign-out-alt"></i>
      <span>ออกจากระบบ</span>
    </a>
  </li> 
</ul>
<style>
  li {
    cursor: pointer;
  }
</style>
<!-- Sidebar -->