<div class="container" ng-app="loginApp" ng-controller="loginCtrl" style="height: 100vh;width: 100vw;display: grid;">
  <div class="card" style="margin: auto;width: 70%;border: 1px solid #6777EF">
    <form>
      <div class="card-header text-center pt-5">
        <h4 class="text-dark" style="font-weight: bold;"><img src="<?= base_url('assets/'); ?>img/boy.png" style="max-width: 60px"> เข้าสู่ระบบเพื่อใช้งานเว็บไซต์</h4>
      </div>
      <div class="card-body">
        <div class="mb-3 row form-row">
          <label for="username" class="col-sm-2 col-form-label text-center">ชื่อผู้ใช้</label>
          <div class="col-sm-10 text-center">
            <input type="text" class="form-control" id="username" ng-model="username" placeholder="username..">
          </div>
        </div>
        <div class="mb-3 row form-row">
          <label for="password" class="col-sm-2 col-form-label text-center">รหัสผ่าน</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" ng-model="password" placeholder="*******">
          </div>
        </div>
        <div class="pt-2 text-center">
          <button style="width: 100%;" type="submit" ng-click="_check_login()" class="btn btn-primary text-white"> เข้าสู่ระบบ</button>
          <hr>
          <a style="width: 100%;" href="<?php echo base_url("BaseController") ?>" class="text-dark"> กลับสู่หน้าหลัก</a>
        </div>
    </form>
  </div>
</div>
<script>
  var app = angular.module('loginApp', []);

  app.controller('loginCtrl', function($scope, $http) {
    $scope._check_login = function() {
      $http.post("<?php echo base_url("LoginController/check_login"); ?>", {
        'username': $scope.username,
        'password': $scope.password,
      }).then(function(response) {
        if (response.data === "1") {
          Swal.fire({
            title: "เข้าสู่ระบบสำเร็จ !",
            icon: 'success',
            showConfirmButton: false,
            timer: 1000
          }).then(function() {
            location.href = '<?php echo base_url("BaseController/view_dashboard"); ?>';
          })
        } else {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการเข้าสู่ระบบ !",
            icon: 'error',
          })
        }
      })
    }
  })
</script>