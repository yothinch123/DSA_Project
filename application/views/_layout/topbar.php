<div id="content-wrapper" class="d-flex flex-column">
  <div id="content">
    <!-- TopBar -->
    <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top  fixed-top" style="background-color: #005792;">
      <?php if ($this->session->userdata('username')) { ?> ?>
        <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>
      <?php } ?>
      <span class="text-white">ร้านกาแฟของวิศวคอมพิวเตอร์นะน้องนะ</span>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <?php
        if ($this->session->userdata('username')) { ?>
          <div class="topbar-divider d-none d-sm-block"></div>
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="img-profile rounded-circle" src="<?= base_url('assets/'); ?>img/boy.png" style="max-width: 60px">
              <span class="ml-2 d-none d-lg-inline text-white small"><?php echo $this->session->userdata('fname'), ' ', $this->session->userdata('lname')  ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" onclick="window.location.href='/CPE/BaseController/view_user'">
                <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                ข้อมูลส่วนต้ว
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" onclick="_logout()">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                ออกจากระบบ
              </a>
            </div>
          </li>
        <?php } else { ?>
          <div class="topbar-divider d-none d-sm-block"></div>
          <div style="display: grid;">
            <button class="btn btn-success" style="margin: auto;" onclick="_login()"> เข้าสู่ระบบ <i class="fas fa-sign-in-alt"></i> </button>
          </div>
        <?php } ?>
      </ul>
    </nav>
    <!-- Topbar -->

    <script>
      function _logout() {
        Swal.fire({
          title: 'คุณต้องการออกจากระบบ ?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'ตกลง',
          cancelButtonText: 'ยกเลิก',
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "<?php echo base_url("/LoginController/logout"); ?>",
              success: function(respone) {
                if (respone) {
                  Swal.fire({
                    icon: 'success',
                    title: 'ออกจากระบบสำเร็จ !',
                    showConfirmButton: false,
                    timer: 1000
                  }).then(() => {
                    location.href = "<?php echo base_url("/BaseController/view_login"); ?>"
                  })
                }
              }
            });

          }
        })
      }

      function _login() {
        location.href = "<?php echo base_url("/BaseController/view_login") ?>"
      }
    </script>