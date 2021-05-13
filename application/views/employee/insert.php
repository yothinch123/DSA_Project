<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;" ng-app="insertEmployeeApp" ng-controller="insertEmployeeCtrl">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
          <h5 class="m-0 text-white">เพิ่มพนักงาน</h5>
        </div>
        <div class="card-body">
          <form>
            <div class=" row">
              <div class="col-12">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="ssn">รหัสบัตรประชาชน <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="ssn" ng-model="ssn" autocomplete="off">
                      <small id="ssn" class="form-text text-muted">Example : 123465</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="fname">ชื่อ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="fname" ng-model="fname" autocomplete="off">
                      <small id="fname" class="form-text text-muted">Example : ใจดี</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="lname">นามสกุล <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="lname" ng-model="lname" autocomplete="off">
                      <small id="lname" class="form-text text-muted">Example : ดีใจ</small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="phone">เบอร์โทรศัพท์ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="phone" ng-model="phone" autocomplete="off">
                      <small id="phone" class="form-text text-muted">Example : 0930000000</small>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="username">ชื่อผู้ใช้ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="username" ng-model="username" autocomplete="off">
                      <small id="username" class="form-text text-muted">Example : xxxxxxxx</small>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="password">รหัสผ่าน <b style="color: #f73859;">*</b> </label>
                      <input type="password" class="form-control" id="password" ng-model="password" autocomplete="off">
                      <small id="password" class="form-text text-muted">Example : xxxxxxx</small>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="jobtitle">ตำแหน่ง <b style="color: #f73859;">*</b> </label>
                      <select class="form-control" ng-model="jobtitle" id="jobtitle">
                        <option disabled value="" selected> 一 เลือกตำแหน่ง 一 </option>
                        <?php
                        $status_array = array('พนักงาน',  'เจ้าของร้าน');
                        foreach ($status_array as $item) {
                          echo '<option value="' . $item . '">' . $item . '</option>';
                        } ?>
                      </select>
                      <small id="jobtitle" class="form-text text-muted">Example : พนักงาน</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="card-footer text-right bg-white" style="height: 75px;">
          <button type="submit" ng-click="_insert()" class="btn btn-primary">บันทึก</button>
          <a href="<?php echo base_url("Base/view_employee"); ?>" type="reset" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  var app = angular.module('insertEmployeeApp', []);

  app.controller('insertEmployeeCtrl', function($scope, $http) {
    $scope._insert = function() {
      if ($scope._check()) {
        $http.post("<?php echo base_url("Employee/insertEmployee"); ?>", {
          'ssn': $scope.ssn,
          'fname': $scope.fname,
          'lname': $scope.lname,
          'username': $scope.username,
          'password': $scope.password,
          'phone': $scope.phone,
          'jobtitle': $scope.jobtitle,
        }).then(function(response) {
          if (response.data === "1") {
            Swal.fire({
              title: "เพิ่มพนักงานสำเร็จ !",
              icon: 'success',
            }).then(function() {
              location.href = '<?php echo base_url("Base/view_employee"); ?>';
            })
          } else {
            Swal.fire({
              title: "เกิดข้อผิดพลาดในการเพิ่มข้อมูล !",
              icon: 'error',
            })
          }
        }, function(response) {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการเพิ่มข้อมูล !",
            icon: 'error',
          })
        })
      }
    }

    $scope._check = function() {
      if ($scope.ssn == undefined || $scope.ssn == '' || $scope.ssn.length !== 13) {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่รหัสบัตรประชาชนให้ครบ 13 หลัก', 'warning')
        return false
      } else if ($scope.fname == undefined || $scope.fname == '') {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่ชื่อ', 'warning')
        return false
      } else if ($scope.lname == undefined || $scope.lname == '') {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่นามสกุล', 'warning')
        return false
      } else if ($scope.username == undefined || $scope.username == '') {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่ชื่อผู้ใช้', 'warning')
        return false
      } else if ($scope.password == undefined || $scope.password == '') {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่รหัสผ่าน', 'warning')
        return false
      } else if ($scope.phone == undefined || $scope.phone == '' || $scope.phone.length !== 10) {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่เบอร์มือถือ 10 หลัก', 'warning')
        return false
      } else if ($scope.jobtitle == undefined || $scope.jobtitle == '') {
        Swal.fire('กรุณาใส่ข้อมูลให้ครบ !', 'กรุณาใส่ตำแหน่ง', 'warning')
        return false
      } else {
        return true
      }
    }

  })
</script>