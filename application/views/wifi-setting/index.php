<div class="container-fluid row" id="container-wrapper" style="margin-top: 90px;" ng-app="updateSettingApp" ng-controller="updateSettingCtrl">
  <div class="col-4">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
        <h5 class="m-0 text-white">ตั้งค่าเวลาใช้งาน Wi-Fi &nbsp; <i class="fas fa-wifi"></i></h5>
      </div>
      <form>
        <div class="card-body">
          <div class="form-group">
            <label for="">เวลาเปิด WIFI</label>
            <input type="time" ng-model="wifi_open" class="form-control">
            <small id="" class="form-text text-muted">Example : 08.00</small>
          </div>
          <div class="form-group">
            <label for="">เวลาปิด WIFI</label>
            <input type="time" ng-model="wifi_close" class="form-control">
            <small id="" class="form-text text-muted">Example : 16.00</small>
          </div>
          <div class="form-group">
            <label for="">ระยะเวลาการใช้งาน WiFI / ชม.</label>
            <input type="number" ng-model="time_use" class="form-control">
            <small id="" class="form-text text-muted">Example : 3 ชั่วโมง</small>
          </div>
          <div class="text-center">
            <button type="submit" ng-click="_update_time()" class="btn btn-info">บันทึก</button>
          </div>
        </div>
      </form>
    </div>
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
        <h5 class="m-0 text-white">ตั้งค่ารหัสผ่านสำหรับเข้าอุปกรณ์</h5>
      </div>
      <form>
        <div class="card-body">
          <div class="form-group">
            <label for="">กรุณาใส่รหัสผ่าน</label>
            <input type="password" ng-model="password" class="form-control">
            <small id="" class="form-text text-muted">Example : xxxx</small>
          </div>
          <div class="text-center">
            <button type="submit" ng-click="_update_pass()" class="btn btn-info">บันทึก</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="col-8">
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
        <h5 class="m-0 text-white">ตั้งค่าข้อมูล Access Point</h5>
        <div>
          <button class="btn btn-success" ng-click="addIndex()"><i class="fas fa-plus"></i> เพิ่ม</button>
        </div>
      </div>
      <div class="card-body">
        <form>
          <div class="row" ng-repeat="text in IPs">
            <div style="margin-top: 40px;">
              <span class="ml-3"> {{ $index + 1 }} </span>
            </div>
            <div class="form-group col">
              <label for="">เลข IP</label>
              <div style="display: flex;">
                <input type="text" ng-model="text.ch1" class="form-control mr-3 text-center">
                <input type="text" ng-model="text.ch2" class="form-control mr-3 text-center">
                <input type="text" ng-model="text.ch3" class="form-control mr-3 text-center">
                <input type="text" ng-model="text.ch4" class="form-control">
              </div>
            </div>
            <div class="form-group col">
              <label for="">รหัส Secret key</label>
              <input type="text" ng-model="text.secretkey" class="form-control">
              <small id="" class="form-text text-muted">Example : xxxxxx</small>
            </div>
            <div style="margin: 33px 30px;">
              <button class="btn btn-danger" ng-click="removeIndex(text.ch1)"><i class="fas fa-times"></i></button>
            </div>
          </div>
      </div>
      <div class="card-footer bg-white text-right" style="height: 75px;">
        <button type="submit" ng-click="_update_ip()" class="btn btn-info" style="width: 100%;">บันทึก</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  var app = angular.module('updateSettingApp', []);
  app.controller('updateSettingCtrl', function($scope, $http) {

    $scope._update_time = function() {
      console.log($scope.wifi_open);
      console.log($scope.wifi_close);
      console.log($scope.time_use);
      $http.post("<?php echo base_url("index.php/Setting/updateSetting"); ?>", {
        'wifi_open': $scope.wifi_open,
        'wifi_close': $scope.wifi_close,
        'time_use': $scope.time_use,
      }).then(function(response) {
        if (response.data === "1") {
          Swal.fire({
            title: "อัพเดตข้อมูลสำเร็จ !",
            icon: 'success',
          }).then(() => {
            location.href = '<?php echo base_url("index.php/Base/view_dashboard"); ?>';
          })
        } else {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการอัพเดตข้อมูล!",
            icon: 'error',
          })
        }
      })
    }

    $scope._update_pass = function() {
      $http.post("<?php echo base_url("index.php/Setting/updateSettingPass"); ?>", {
        'password': $scope.password
      }).then(function(response) {
        if (response.data === "1") {
          $scope.password = null;
          Swal.fire({
            title: "อัพเดตรหัสผ่านสำเร็จ !",
            icon: 'success',
          }).then(() => {
            location.href = '<?php echo base_url("index.php/Base/view_dashboard"); ?>';
          })
        } else {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการอัพเดตรหัสผ่าน!",
            icon: 'error',
          })
        }
      })
    }

    $scope.IPs = [{}]

    $scope.addIndex = function() {
      var newIP = {};
      $scope.IPs.push(newIP);
    }

    $scope.removeIndex = function(ip) {
      console.log(ip);
      var index = $scope.IPs.indexOf(ip);
      $scope.IPs.splice(index, 1);
    }
  })
</script>