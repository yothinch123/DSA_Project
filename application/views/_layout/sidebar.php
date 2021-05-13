<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="margin-top: 70px;">
  <hr class="sidebar-divider my-0">

  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    Features
  </div>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/Base/view_dashboard'" style="color: white;">
      <i class="fas fa-home"></i>
      <span>หน้าหลัก</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/Base/view_statistics'" style="color: white;">
      <i class="fas fa-edit"></i>
      <span>จัดการรายงานข้อมูล</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/Base/view_wifi_setting'" style="color: white;">
      <i class="fas fa-edit"></i>
      <span>จัดการตั้งค่าอุปกรณ์</span>
    </a>
  </li>
  <?php if ($this->session->userdata('jobtitle') == "เจ้าของร้าน") { ?>
    <li class="nav-item">
      <a class="nav-link" onclick="window.location.href='/CPE/Base/view_employee'" style="color: white;">
        <i class="fas fa-edit"></i>
        <span>จัดการผู้ใช้งานระบบ</span>
      </a>
    </li>
  <?php } ?>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    USER
  </div>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/Base/view_user'" style="color: white;">
      <i class="fas fa-edit"></i>
      <span>จัดการข้อมูลส่วนตัว</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="window.location.href='/CPE/Base/view_rules'" style="color: white;">
      <i class="far fa-file-pdf"></i>&nbsp;
      <span>ไฟล์เงื่อนไขการให้บริการ</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" onclick="_logout()" style="color: white;">
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