<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
          <h5 class="m-0 text-white">รายละเอียดข้อมูลและสถิติเกี่ยวกับการใช้งานของลูกค้า</h5>
        </div>
        <div class="card-body" ng-app="reportApp" ng-controller="reportCtrl" ng-init="_fetchData()">
          <div style="width: 30%;float: right;" id="select">
            <select class="custom-select" onchange="select_view(this)">
              <option value="customer">สถิติจำนวนของลูกค้า</option>
              <option value="old_customer">สถิติลูกค้าเดิม</option>
              <option value="statistics_time_use">สถิติเรื่องเวลาการใช้งานต่อคนต่อช่วงเวลา / วัน</option>
            </select>
          </div>

          <div class="pt-5" id="customer" style="display: block">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="day-tab" data-toggle="tab" href="#day" role="tab" aria-controls="day" aria-selected="true">วัน</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="weekend-tab" data-toggle="tab" href="#weekend" role="tab" aria-controls="weekend" aria-selected="false">สัปดาห์</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="month-tab" data-toggle="tab" href="#month" role="tab" aria-controls="month" aria-selected="false">เดือน</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="year-tab" data-toggle="tab" href="#year" role="tab" aria-controls="year" aria-selected="false">ปี</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="day" role="tabpanel" aria-labelledby="day-tab"><br>
                <div style="height: 69vh; overflow-y: scroll;">
                  <canvas id="day_chart" style="width: 1300px;height: 1500px;"></canvas>

                  <!-- <form method="post" action="<?php echo base_url(); ?>index.php/excel_export">
                      <input type="submit" name="export" class="btn btn-success" value="Exportss" />
                    </form>
                    <form method="post" action="<?php echo base_url(); ?>index.php/export_csv/export_day">
                      <button type="submit" class="btn" style="color: white; background-color: #0ea47a;"><i class="fas fa-sort-amount-down-alt"></i> Excel</button>
                    </form> -->
                </div>
              </div>

              <div class="tab-pane fade" id="weekend" role="tabpanel" aria-labelledby="weekend-tab"><br>
                <div style="display: flex;justify-content: space-between;">
                  <h5>สถิติลูกค้าแบบรายสัปดาห์</h5>
                  <div>
                    <form method="post" action="<?php echo base_url(); ?>index.php/export_csv/export_week">
                      <button type="submit" class="btn" style="color: white; background-color: #0ea47a;"><i class="fas fa-sort-amount-down-alt"></i> Excel</button>
                    </form>
                  </div>
                </div>


              </div>
              <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab"><br>
                <div style="height: 65vh; overflow-y: scroll;">
                  <canvas id="month_chart" style="width: 1300px;height: 500px;"></canvas>
                  <!-- <form method="post" action="<?php echo base_url(); ?>index.php/export_csv/export_month">
                      <button type="submit" class="btn" style="color: white; background-color: #0ea47a;"><i class="fas fa-sort-amount-down-alt"></i> Excel</button>
                    </form> -->
                </div>
              </div>


              <div class="tab-pane fade" id="year" role="tabpanel" aria-labelledby="year-tab"><br>
                <div>
                  <canvas id="year_chart" style="width: 1300px;height: 500px;"></canvas>
                  <!-- <form method="post" action="<?php echo base_url(); ?>index.php/export_csv/export_year">
                    <button type="submit" class="btn" style="color: white; background-color: #0ea47a;"><i class="fas fa-sort-amount-down-alt"></i> Excel</button>
                  </form> -->
                </div>
              </div>

            </div>
          </div>
          <div id="old_customer" style="display: none">
            <div>
              <canvas id="old_cust_chart" style="width: 1300px;height: 500px;"></canvas>
              <!-- <form method="post" action="<?php echo base_url(); ?>index.php/export_csv/export_old">
                  <button type="submit" class="btn" style="color: white; background-color: #0ea47a;"><i class="fas fa-sort-amount-down-alt"></i> Excel</button>
                </form> -->
            </div>
          </div>
          <!-- <div class="statistics_time_use page">
            <h5 id="h5">สถิติเรื่องเวลาการใช้งานต่อคนต่อช่วงเวลา / วัน</h5>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="day2-tab" data-toggle="tab" href="#day2" role="tab" aria-controls="day2" aria-selected="true">วัน</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="weekend2-tab" data-toggle="tab" href="#weekend2" role="tab" aria-controls="weekend2" aria-selected="false">สัปดาห์</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="month2-tab" data-toggle="tab" href="#month2" role="tab" aria-controls="month2" aria-selected="false">เดือน</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="year2-tab" data-toggle="tab" href="#year2" role="tab" aria-controls="year2" aria-selected="false">ปี</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="day2" role="tabpanel" aria-labelledby="day2-tab"><br> สวัสดีครับ นี่คือสถิติรายวัน.</div>
              <div class="tab-pane fade" id="weekend2" role="tabpanel" aria-labelledby="weekend2-tab"><br> สวัสดีครับ นี่คือสถิติรายสัปดาห์.</div>
              <div class="tab-pane fade" id="month2" role="tabpanel" aria-labelledby="month2-tab"><br> สวัสดีครับ นี่คือสถิติรายเดือน</div>
              <div class="tab-pane fade" id="year2" role="tabpanel" aria-labelledby="year2-tab"><br> สวัสดีครับ นี่คือสถิติรายปี</div>
            </div>
          </div> -->


        </div>
      </div>
    </div>
  </div>


</div>

<script>
  var app = angular.module('reportApp', []);

  app.controller('reportCtrl', function($scope, $http) {
    $scope._fetchData = function() {
      $scope._report_day();
      $scope._report_month();
      $scope._report_year();
      $scope._report_old_cust();
    }

    $scope._report_day = function() {
      $scope.total_report_day = [];
      $scope.register_report_day = [];

      $http.post("<?php echo base_url("ReportController/fetchReportByDay"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_day.push(item.total)
          $scope.register_report_day.push(item.register_time)
        })

        var ctx = document.getElementById("day_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
            datasets: [{
              label: 'จำนวนลูกค้า',
              data: $scope.total_report_day,
              backgroundColor: "#ca82f8",
            }],
            labels: $scope.register_report_day,
            borderWidth: 1,
          },
          options: {
            responsive: true
          },
        });
      });
    }

    $scope._report_month = function() {
      $scope.total_report_month = [];
      $scope.register_report_month = [];

      $http.post("<?php echo base_url("ReportController/fetchReportByMonth"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_month.push(item.total)
          $scope.register_report_month.push(item.register_time)
        })

        var ctx = document.getElementById("month_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
            datasets: [{
              label: 'จำนวนลูกค้า',
              data: $scope.total_report_month,
              backgroundColor: "#f38181",
            }],
            labels: $scope.register_report_month,
            borderWidth: 1,
          },
          options: {
            responsive: true
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }],
          }
        });
      });

    }

    $scope._report_year = function() {
      $scope.total_report_year = [];
      $scope.register_report_year = [];

      $http.post("<?php echo base_url("ReportController/fetchReportByYear"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_year.push(item.total)
          $scope.register_report_year.push(item.register_time)
        })

        var ctx = document.getElementById("year_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
            datasets: [{
              label: 'จำนวนลูกค้า',
              data: $scope.total_report_year,
              backgroundColor: "#f38181",
            }],
            labels: $scope.register_report_year,
            borderWidth: 1,
          },
          options: {
            responsive: true
          },
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }],
          }
        });
      });
    }
    
    $scope._report_old_cust = function() {
      $scope.total_report_old_cust= [];
      $scope.register_report_old_cust = [];

      $http.post("<?php echo base_url("ReportController/fetchReportByoldCust"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_old_cust.push(item.total)
          $scope.register_report_old_cust.push(item.ssn)
        })

        var ctx = document.getElementById("old_cust_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
            datasets: [{
              label: 'จำนวนครั้ง',
              data: $scope.total_report_old_cust,
              backgroundColor: "#ca82f8",
            }],
            labels: $scope.register_report_old_cust,
            borderWidth: 1,
          },
          options: {
            responsive: true
          },
        });
      });
    }

  })

  function select_view(e) {
    var select = e.value;

    if (select === "customer") {
      document.getElementById('customer').style.display = "block";
      document.getElementById('old_customer').style.display = "none";

    } else if (select === "old_customer") {
      document.getElementById('customer').style.display = "none";
      document.getElementById('old_customer').style.display = "block";
    }
  }
</script>