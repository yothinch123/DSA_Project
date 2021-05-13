<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;" ng-app="updateEmployeeApp" ng-controller="updateEmployeeCtrl">
  <div class="row mb-3">
    <div class="col-1"></div>
    <div class="col-10">
      <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
          <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
            <h5 class="m-0 text-white">ข้อมูลส่วนตัว</h5>
            <button class="btn btn-success" data-toggle="modal" data-target="#passwordModal"><i class="fas fa-unlock-alt"></i> เปลี่ยนรหัสผ่าน </button>
          </div>
          <div class="card-body text-left">
            <div class="d-flex justify-content-between">
              <div class="text-center col-4" style="display: grid;border: 1px solid grey;">
                <img src="<?= base_url('assets/'); ?>img/boy.png" style="width: 60%;height: 60%;margin: auto;">
              </div>
              <div class="col-8 pl-5">
                <table class="table table-borderless" style="width: 100%;">
                  <tr>
                    <td style="width: 40%;">
                      <label for="ssn" style="font-weight: bold;">รหัสบัตรประชาชน</label>
                    </td>
                    <td>
                      <span><?= $this->session->userdata('ssn') ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="fname" style="font-weight: bold;">ชื่อ</label>
                    </td>
                    <td>
                      <span><?= $this->session->userdata('fname') ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="lname" style="font-weight: bold;">นามสกุล</label>
                    </td>
                    <td>
                      <span><?= $this->session->userdata('lname') ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="phone" style="font-weight: bold;">เบอร์โทรศัพท์</label>
                    </td>
                    <td>
                      <span><?= $this->session->userdata('phone') ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="username" style="font-weight: bold;">ชื่อผู้ใช้</label>
                    </td>
                    <td>
                      <span><?= $this->session->userdata('username') ?></span>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <label for="jobtitle" style="font-weight: bold;">ตำแหน่ง</label>
                    </td>
                    <td>
                      <span><?= $this->session->userdata('jobtitle') ?></span>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="card-footer">
          </div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
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

    $scope._update_pass = function() {
      $http.post("<?php echo base_url("Employee/updatePasswordEmp"); ?>", {
        'id': <?php echo $this->session->userdata('id') ?>,
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

  })
</script>