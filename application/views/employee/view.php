 <?php $this->load->view('_layout/loading'); ?>
 <div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
   <div class="row mb-3">
     <div class="col-xl-12 col-lg-12">
       <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
           <h5 class="m-0 text-white">ข้อมูลพนักงาน</h5>
           <button class="btn btn-success" onclick="window.location.href='/CPE/Base/view_employee_insert'">เพิ่มพนักงาน <i class="fas fa-user-plus"></i></button>
         </div>
         <div class="card-body" ng-app="myApp" ng-controller="employeeCtrl">
           <div class="col-lg-12">
             <div class="table-responsive p-3">
               <table class="table table-hover table-striped text-center" id="TableEmployee" ng-init="_fetchData()">
                 <thead style="background-color: white;color: #323232;">
                   <tr>
                     <th>ลำดับ</th>
                     <th>ชื่อ</th>
                     <th>นามสกุล</th>
                     <th>เบอร์โทรศัพท์</th>
                     <th>ชื่อผู้ใช้</th>
                     <th>ตำแหน่ง</th>
                     <th>จัดการ</th>
                     <th>ประวัติการเข้าสู่ระบบ</th>
                   </tr>
                 </thead>
                 <tbody style="color: black;">
                   <tr ng-repeat="employee in employees">
                     <td>{{ $index + 1 }}</td>
                     <td>{{ employee.fname }}</td>
                     <td>{{ employee.lname }}</td>
                     <td>{{ employee.phone }}</td>
                     <td>{{ employee.username }}</td>
                     <td>{{ employee.jobtitle }}</td>
                     <td>
                       <a href="http://localhost/CPE/Base/view_employee_update?id={{employee.id}}" class="btn btn-outline-warning btn-sm"><i class="far fa-edit"></i></a>
                       <button id={{employee.id}} class="btn btn-outline-danger btn-sm" ng-click="_deleteID(employee.id)" value='Delete'><i class="fas fa-trash"></i></button>
                     </td>
                     <td>
                       <button class="btn btn-outline-primary btn-sm" ng-click="_showLogin(employee.username,employee.fname)"><i class="fas fa-search"></i></button>
                     </td>
                   </tr>
                 </tbody>
               </table>
             </div>
           </div>

           <div class="modal fade" tabindex="-1" role="dialog" id="Logfile">
             <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 style="color: black;text-align: center;" class="modal-title pl-3" id="logFileLabel">ประวัติการเข้าสู่ระบบของ {{ name }} </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                   </button>
                 </div>
                 <div class="modal-body">
                   <div class="table-responsive p-3">
                     <table class="table table-hover table-striped text-center table-borderless" id="TableEmployee" ng-init="_fetchData()">
                       <thead style="background-color: #6777EF;color: white;">
                         <tr>
                           <th>ครั้งที่</th>
                           <th>เวลาที่เข้าสู่ระบบ</th>
                           <th>เวลาที่ออกจากระบบ</th>
                         </tr>
                       </thead>
                       <tbody style="color: black;">
                         <tr ng-repeat="data in loginDatas">
                           <td>{{ $index + 1 }}</td>
                           <td>{{ data.login_time }}</td>
                           <td>{{ data.logout_time }}</td>
                         </tr>
                       </tbody>
                     </table>
                   </div>
                 </div>
               </div>
             </div>
           </div>

         </div>
       </div>
     </div>

   </div>


   <script>
     var app = angular.module('myApp', []);
     app.controller('employeeCtrl', function($scope, $http) {

       $scope._fetchData = function() {
         $http.post("<?php echo base_url("index.php/Employee/getEmployeeBy"); ?>").then(
           function(response) {
             $scope.employees = response.data;
           });
       }

       $scope._showLogin = function(username, name) {
         $http.post("<?php echo base_url("index.php/Employee/getEmployeeLoginByCode"); ?>", {
           'username': username,
         }).then(function(response) {
           $scope.loginDatas = response.data;
           $scope.name = name;
           $scope.openModal();
         });
       }

       $scope.openModal = function() {
         $('#Logfile').modal('show')
       };

       $scope._deleteID = function(id) {
         Swal.fire({
           title: 'คุณต้องการลบข้อมูลพนักงาน ?',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'ตกลง',
           cancelButtonText: 'ยกเลิก',
         }).then((result) => {
           if (result.isConfirmed) {
             $http.post("<?php echo base_url("index.php/Employee/deleteEmployee"); ?>", {
               'id': id,
             }).then(function(response) {
               if (response) {
                 Swal.fire({
                   title: "ลบข้อมูลสำเร็จ !",
                   icon: 'success',
                 }).then(function() {
                   $scope._fetchData();
                 })
               } else {
                 Swal.fire({
                   title: "เกิดข้อผิดพลาดในการลบข้อมูล !",
                   icon: 'error',
                 })
               }
             })
           }
         })
       }
     });
   </script>