<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;" ng-app="updateEmployeeApp" ng-controller="updateEmployeeCtrl" ng-init="_fetchData()">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
          <h5 class="m-0 text-white">แก้ไขข้อมูลพนักงาน</h5>
          <button class="btn btn-warning" data-toggle="modal" data-target="#passwordModal"><i class="fas fa-unlock-alt"></i> เปลี่ยนรหัสผ่าน </button>
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
                  <div class="col-4">
                    <div class="form-group">
                      <label for="phone">เบอร์โทรศัพท์ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="phone" ng-model="phone" autocomplete="off">
                      <small id="phone" class="form-text text-muted">Example : 0930000000</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="username">ชื่อผู้ใช้ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="username" ng-model="username" autocomplete="off">
                      <small id="username" class="form-text text-muted">Example : xxxxxxxx</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="jobtitle">ตำแหน่ง <b style="color: #f73859;">*</b> </label>
                      <select class="form-control" ng-model="jobtitle" id="jobtitle">
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
          <button type="submit" ng-click="_update()" class="btn btn-primary">บันทึก</button>
          <a href="<?php echo base_url("BaseController/view_employee"); ?>" type="reset" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- modal password -->

  <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="font-weight: bold;" class="modal-title text-dark" id="passwordLabel">กรุณาระบุรหัสผ่านใหม่ <b style="color: red;">*</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="password" class="form-control" id="password" ng-model="password" autocomplete="off">
          <small>Example. xxxxx</small>
        </div>
        <div class="modal-footer">
          <button type="submit" ng-click="_update_pass()" class="btn btn-primary">ยืนยัน</button>
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">ยกเลิก</button>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  var app = angular.module('updateEmployeeApp', []);

  app.controller('updateEmployeeCtrl', function($scope, $http) {

    $scope._fetchData = function() {
      $http.post("<?php echo base_url("EmployeeController/getEmployeeByCode"); ?>", {
        'id': <?php echo $_GET['id'] ?>,
      }).then(function(response) {
        var user = response.data;
        $scope.ssn = user.ssn,
          $scope.fname = user.fname,
          $scope.lname = user.lname,
          $scope.username = user.username,
          $scope.phone = user.phone,
          $scope.jobtitle = user.jobtitle
      });
    }

    $scope._update_pass = function() {
      $http.post("<?php echo base_url("EmployeeController/updatePasswordEmp"); ?>", {
        'id': <?php echo $_GET['id'] ?>,
        'password': $scope.password,
      }).then(function(response) {
        if (response.data === "1") {
          $scope.password = null;
          Swal.fire({
            title: "อัพเดตรหัสผ่านสำเร็จ !",
            icon: 'success',
          }).then(() => {
            $('#passwordModal').modal('hide')
          })
        } else {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการอัพเดตรหัสผ่าน!",
            icon: 'error',
          })
        }
      })
    }

    $scope._update = function() {
      $http.post("<?php echo base_url("EmployeeController/updateEmployee"); ?>", {
        'id': <?php echo $_GET['id'] ?>,
        'ssn': $scope.ssn,
        'fname': $scope.fname,
        'lname': $scope.lname,
        'username': $scope.username,
        'phone': $scope.phone,
        'jobtitle': $scope.jobtitle,
      }).then(function(response) {
        if (response.data === "1") {
          Swal.fire({
            title: "อัพเดตข้อมูลสำเร็จ !",
            icon: 'success',
          }).then(function() {
            location.href = '<?php echo base_url("BaseController/view_employee"); ?>';
          })
        } else {
          Swal.fire({
            title: "เกิดข้อผิดพลาดในการอัพเดตข้อมูล !",
            icon: 'error',
          })
        }
      }, function(response) {
        Swal.fire({
          title: "เกิดข้อผิดพลาดในการอัพเดตข้อมูล !",
          icon: 'error',
        })
      })
    }
  })
</script>