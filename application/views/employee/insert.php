<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;" ng-app="insertEmployeeApp" ng-controller="insertEmployeeCtrl">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #3490de;">
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
          <a href="" type="reset" class="btn btn-secondary">ย้อนกลับ</a>
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
      $http.post("<?php echo base_url("EmployeeController/insertEmployee"); ?>", {
        'ssn': $scope.ssn,
        'fname': $scope.fname,
        'lname': $scope.lname,
        'username': $scope.username,
        'password': $scope.password,
        'phone': $scope.phone,
        'jobtitle': $scope.jobtitle,
      }).then(function(response) {
        console.log("response : ",response.data);
        if (response.data === "1") {
          Swal.fire({
            title: "เพิ่มพนักงานสำเร็จ !",
            icon: 'success',
          }).then(function() {
            location.href = '<?php echo base_url("BaseController/view_employee"); ?>';
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
  })
</script>