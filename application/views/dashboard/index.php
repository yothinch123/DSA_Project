<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;" ng-app="dashboardApp" ng-controller="reportCtrl" ng-init="_fetchData()">
  <div class="row mb-3">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">จำนวนลูกค้าทีใช้งานวันนี้</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">35 คน</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <!-- <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                <span>Since last month</span> -->
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-wifi fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">จำนวนลูกค้าทั้งหมด</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ total_customer }} คน </div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                <span>Since last years</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- New User Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">ชื่อไวไฟ</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">CPE-Cafe</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                <span>Since last month</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">ระยะเวลาการให้บริการไวไฟ</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">3 ชม</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                <span>Since yesterday</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card mb-4" style="height: 750px;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">กราฟแสดงจำนวนลูกค้าของวันนี้</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="chart-area">
            <canvas id="day_chart" style="width: 500px;height:310px"></canvas>
          </div>
        </div>
      </div>
    </div>
    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card" style="height:200px;">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">ไฟล์ข้อบังคับการใข้งาน</h6>
        </div>
        <div class="card-body text-center">
        <span class="text-dark">เป็นไฟล์ที่ระบุข้อตกลงก่อนเริ่มต้นการใช้งานเครือข่าย</span>
          <a href="http://localhost/CPE/assets/ข้อบังคับการใช้งาน.docx" class="mt-4 btn btn-info" style="width: 90%;"><i class="fas fa-download"></i>&nbsp ดาวน์โหลดไฟล์</a>
        </div>
      </div>

      <div class="card mb-4 mt-3" style="height: 520px;">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">ปฏิทิน</h6>
        </div>
        <div class="card-body">
          <div id='calendar'></div>
        </div>
      </div>
    </div>

  </div>

</div>


<script>
  var app = angular.module('dashboardApp', []);

  app.controller('reportCtrl', function($scope, $http) {
    $scope._fetchData = function() {
      $scope._report_today();
    }

    $scope._report_today = function() {
      $scope.total_customer_now = [];
      $scope.all_times = [];

      $http.post("<?php echo base_url("Report/fetchReportByDay"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_customer_now.push(item.total)
        })
        for (let time = 0; time < 24; time++) {
          time > 9 ?
            $scope.all_times.push(time.toString() + ".00 น.") :
            $scope.all_times.push("0" + time.toString() + ".00 น.")
        }
        var ctx = document.getElementById("day_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
            datasets: [{
              label: 'จำนวนลูกค้า',
              data: $scope.total_customer_now,
              backgroundColor: "#ca82f8",
            }],
            labels: $scope.all_times,
            borderWidth: 1,
          },
          options: {
            responsive: true
          },
        });
      });

      $http.post("<?php echo base_url("Report/fetchReportByoldCust"); ?>").then(function(response) {
        $scope.total_customer = response.data.length
      });
    }

  })

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth'
    });
    calendar.render();
  });
</script>