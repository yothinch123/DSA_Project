 <div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
   <div class="row mb-3">
     <div class="col-xl-12 col-lg-12">
       <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
           <h5 class="m-0 text-white">ข้อมูลพนักงาน</h5>
           <button class="btn btn-success" onclick="window.location.href='/CPE/BaseController/view_employee_insert'">เพิ่มพนักงาน <i class="fas fa-user-plus"></i></button>
         </div>
         <div class="card-body" ng-app="myApp" ng-controller="employeeCtrl">
           <div class="col-lg-12">
             <div class="table-responsive p-3">
               <table class="table table-hover text-center" id="TableEmployee" ng-init="_fetchData()">
                 <thead style="background-color: grey;color: white;">
                   <tr>
                     <th>ลำดับ</th>
                     <th>ชื่อ</th>
                     <th>นามสกุล</th>
                     <th>เบอร์โทรศัพท์</th>
                     <th>ชื่อผู้ใช้</th>
                     <th>ตำแหน่ง</th>
                     <th>จัดการ</th>
                     <th></th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr ng-repeat="employee in employees">
                     <td>{{ $index + 1 }}</td>
                     <td>{{ employee.fname }}</td>
                     <td>{{ employee.lname }}</td>
                     <td>{{ employee.phone }}</td>
                     <td>{{ employee.username }}</td>
                     <td>{{ employee.jobtitle }}</td>
                     <td>
                       <a href="http://localhost/CPE/BaseController/view_employee_update?id={{employee.id}}" class="btn btn-warning btn-sm"><i class="far fa-edit"></i></a>
                       <button id={{employee.id}} class="btn btn-danger btn-sm" ng-click="_deleteID(employee.id)" value='Delete'><i class="fas fa-trash"></i></button>
                     </td>
                     <td>
                       <button class="btn btn-link btn-sm text-dark" data-toggle="modal" data-target="#logFileModal">ประวัติการเข้าสู่ระบบ</button>
                     </td>
                   </tr>
                 </tbody>
               </table>
             </div>
           </div>
         </div>
       </div>
     </div>

   </div>

   <div class="modal fade" id="logFileModal" tabindex="-1" role="dialog" aria-labelledby="logFileLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <h5 style="font-weight: bold;" class="modal-title text-dark" id="logFileLabel">ประวัติการเข้าสู่ระบบของ <?= $this->session->userdata('fname') ?></h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           this is Login History
         </div>
         <div class="modal-footer">
         </div>
       </div>
     </div>
   </div>

   <script>
     var app = angular.module('myApp', []);
     app.controller('employeeCtrl', function($scope, $http) {
       $scope._fetchData = function() {
         $http.post("<?php echo base_url("EmployeeController/getEmployeeBy"); ?>").then(
           function(response) {
             $scope.employees = response.data;
           });
       }
       $scope._deleteID = function(id) {
         Swal.fire({
           title: 'คุณต้องการลบพนักงานคนนี้ ?',
           icon: 'warning',
           showCancelButton: true,
           confirmButtonText: 'ตกลง',
           cancelButtonText: 'ยกเลิก',
         }).then((result) => {
           if (result.isConfirmed) {
             $http.post("<?php echo base_url("EmployeeController/deleteEmployee"); ?>", {
               'id': id,
             }).then(function(response) {
               if (response) {
                 Swal.fire({
                   title: "ลบพนักงานสำเร็จ !",
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