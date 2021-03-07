 <div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
   <div class="row mb-3">
     <div class="col-xl-12 col-lg-12">
       <div class="card mb-4">
         <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #3490de;">
           <h5 class="m-0 text-white">ข้อมูลพนักงาน</h5>
           <button class="btn btn-success" onclick="window.location.href='/CPE/index.php/BaseController/view_employee_insert'">เพิ่มพนักงาน <i class="fas fa-user-plus"></i></button>
         </div>
         <div class="card-body" ng-app="myApp" ng-controller="employeeCtrl">
           <div class="col-lg-12">
             <div class="table-responsive p-3">
               <table class="table table-hover table-striped table-borderless" id="TableEmployee" ng-init="fetchData()">
                 <thead style="border-bottom: 1px solid #5f6769;">
                   <tr>
                     <th>ลำดับ</th>
                     <th>ชื่อ</th>
                     <th>นามสกุล</th>
                     <th>เบอร์โทรศัพท์</th>
                     <th>ชื่อผู้ใช้</th>
                     <th>ตำแหน่ง</th>
                     <th>จัดการ</th>
                     <th>#</th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr ng-repeat="item in datas">
                     <td>{{ item.id }}</td>
                     <td>{{ item.fname }}</td>
                     <td>{{ item.lname }}</td>
                     <td>{{ item.phone }}</td>
                     <td>{{ item.username }}</td>
                     <td>{{ item.jobtitle }}</td>
                     <td>
                       <button class="btn btn-warning btn-sm"><i class="far fa-edit"></i></button>
                       <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                     </td>
                     <td>
                       <button class="btn btn-link btn-sm text-dark">ประวัติการเข้าสู่ระบบ</button>
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

   <script>
     var app = angular.module('myApp', []);
     app.controller('employeeCtrl', function($scope, $http) {
       $scope.fetchData = function() {
         $http.post("<?php echo base_url("index.php/EmployeeController/getEmployeeBy"); ?>").then(function mySuccess(response) {
           $scope.datas = response.data;
         });
       }
     });
   </script>