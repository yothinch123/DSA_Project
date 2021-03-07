<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" style="margin-top: 70px;">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/'); ?>img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">Ruang Admin</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" onclick="window.location.href='/CPE/index.php/BaseController/view_dashboard'" style="color: #222831;">
            <i class="far fa-chart-bar"></i>
            <span>แดชบอร์ด</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>
    <li class="nav-item">
        <a class="nav-link" onclick="window.location.href='/CPE/index.php/BaseController/view_wifi_setting'" style="color: #222831;">
            <i class="fas fa-wifi"></i>
            <span>ตั้งค่า Wi-Fi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="window.location.href='/CPE/index.php/BaseController/view_statistics'" style="color: #222831;">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>รายละเอียดและสถิติ</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="window.location.href='/CPE/index.php/BaseController/view_employee'" style="color: #222831;">
            <i class="fas fa-users"></i>
            <span>ข้อมูลพนักงาน</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" onclick="window.location.href='/CPE/index.php/BaseController/view_employee_detail'" style="color: #222831;">
            <i class="fas fa-user-edit"></i>
            <span>ข้อมูลส่วนตัว</span>
        </a>
    </li>
    <hr class="sidebar-divider">
</ul>
<!-- Sidebar -->