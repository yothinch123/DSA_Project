<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;" ng-app="updateSettingApp" ng-controller="updateSettingCtrl">
  <div class="card mb-4" style="width: 50%;display: grid;margin: auto;">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
      <h5 class="m-0 text-white">ตั้งค่า Wi-Fi</h5>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="ssn">เวลาเปิด WIFI</label>
          <input type="time" ng-model="wifi_open" class="form-control">
          <small id="ssn" class="form-text text-muted">Example : 08.00</small>
        </div>

        <div class="form-group">
          <label for="ssn">เวลาปิด WIFI</label>
          <input type="time" ng-model="wifi_close" class="form-control">
          <small id="ssn" class="form-text text-muted">Example : 16.00</small>
        </div>

        <div class="form-group">
          <label for="ssn">ชื่อร้าน</label>
          <input type="text" ng-model="name_cafe" class="form-control">
          <small id="ssn" class="form-text text-muted">* มีหรือไม่มีก็ได้</small>
        </div>
    </div>
    <div class="card-footer bg-white text-center" style="height: 75px;">
      <button type="submit" ng-click="_update()" class="btn btn-warning">บันทึก</button>
      <button type="reset" class="btn btn-secondary">ยกเลิก</button>
    </div>
    </form>
  </div>
</div>

<script>
  var app = angular.module('updateSettingApp', []);
  app.controller('updateSettingCtrl', function($scope, $http) {

    $scope._update = function() {
      $http.post("<?php echo base_url("SettingController/updateSetting"); ?>", {
        'wifi_open': $scope.wifi_open,
        'wifi_close': $scope.wifi_close,
        'name_cafe': $scope.name_cafe,
      }).then(function(response) {
        if (response.data === "1") {
          $scope.password = null;
          Swal.fire({
            title: "อัพเดตข้อมูลสำเร็จ !",
            icon: 'success',
          }).then(() => {
            location.href = '<?php echo base_url("BaseController/view_dashboard"); ?>';
          })
        } else {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการอัพเดตข้อมูล!",
            icon: 'error',
          })
        }
      })
    }
  })
</script>