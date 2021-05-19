<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4" ng-app="reportApp" ng-controller="reportCtrl" ng-init="_fetchData()">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-primary">
          <h5 class="m-0 text-white">รายละเอียดข้อมูลและสถิติเกี่ยวกับการใช้งานของลูกค้า</h5>
          <button class="btn btn-success" ng-click="_export_hist()">ส่งออกประวัติการใช้งานของลูกค้า <i class="fas fa-file-download"></i></button>
        </div>
        <div class="card-body">
          <div style="width: 30%;float: right;" id="select">
            <select class="custom-select" style="cursor: pointer;" onchange="select_view(this)">
              <option value="stat_customer">กราฟแสดงจำนวนของลูกค้า</option>
              <option value="stat_old_customer">กราฟแสดงข้อมูลของลูกค้าเดิม</option>
              <option value="stat_custom">กราฟแสดงข้อมูลแบบกำหนดวัน</option>
            </select>
          </div>

          <div class="pt-5" id="stat_customer" style="display: block">
            <ul class="nav nav-tabs" id="myTab" style="display: flex;justify-content: center;" role="tablist">
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
                  <button style="float: right;" class="btn btn-success mr-3" ng-click="_export_csv('day')"> csv</button>
                  <canvas id="day_chart" width="400" height="150"></canvas>
                </div>
              </div>

              <div class="tab-pane fade" id="weekend" role="tabpanel" aria-labelledby="weekend-tab"><br>
                <div style="height: 65vh; overflow-y: scroll;">
                  <button style="float: right;" class="btn btn-success mr-3" ng-click="_export_csv('week')"> csv</button>
                  <canvas id="week_chart" width="400" height="150"></canvas>
                </div>
              </div>

              <div class="tab-pane fade" id="month" role="tabpanel" aria-labelledby="month-tab"><br>
                <div style="height: 65vh; overflow-y: scroll;">
                  <button style="float: right;" class="btn btn-success mr-3" ng-click="_export_csv('month')"> csv</button>
                  <canvas id="month_chart" width="400" height="100"></canvas>
                </div>
              </div>

              <div class="tab-pane fade" id="year" role="tabpanel" aria-labelledby="year-tab"><br>
                <div style="height: 65vh; overflow-y: scroll;">
                  <button style="float: right;" class="btn btn-success mr-3" ng-click="_export_csv('year')"> csv</button>
                  <canvas id="year_chart" width="400" height="50"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div id="stat_old_customer" style="display: none;" class="pt-5">
            <div style="border-bottom: 1px solid #c9d6df;height: 60px;">
              <button style="float: right;" class="btn btn-success mt-2" ng-click="_export_csv('old_cust')"> csv</button>
            </div>
            <div class="pt-3" style="height: 65vh; overflow-y: scroll;">
              <canvas id="old_cust_chart" width="400" height="150"></canvas>
            </div>
          </div>

          <div id="stat_custom" style="display: none;" class="pt-5">
            <button style="float: right;" class="btn btn-success mt-4" ng-click="_export_csv_custom()"> csv</button>
            <div style="border-bottom: 1px solid #c9d6df; padding: 20px 20px 20px 20px;">
              <div style="display: flex;justify-content:center">
                <div></div>
                <div>
                  <Label>จากวันที่</Label>
                  <input class="btn btn-outline-light ml-2" ng-model="date_start" type="date">
                  <Label class="ml-2">ถึงวันที่</Label>
                  <input class="btn btn-outline-light ml-2" ng-model="date_end" type="date">
                  <button class="btn btn-info ml-3" ng-click="_search_custom()"><i class="fas fa-search"></i> ค้นหา</button>
                </div>
              </div>
            </div>
            <div style="height: 69vh; overflow-y: scroll;">
              <canvas id="custom_chart" width="400" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var app = angular.module('reportApp', []);

  app.controller('reportCtrl', function($scope, $http) {

    $scope._fetchData = function() {
      $scope._round_fetch_data();
      $scope._report_day();
      $scope._report_week();
      $scope._report_month();
      $scope._report_year();
      $scope._report_old_cust();
    }

    $scope._round_fetch_data = function() {
      $http.post("<?php echo base_url("Report/roundFetch"); ?>")
    }

    $scope._report_day = function() {
      $scope.total_report_day = [];
      $scope.register_report_day = [];

      $http.post("<?php echo base_url("Report/fetchReportByDay"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_day.push(item.total)
          $scope.register_report_day.push(item.time)
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

    $scope._report_week = function() {
      $scope.total_report_week = [];
      $scope.register_report_week = [];

      $http.post("<?php echo base_url("Report/fetchReportByWeek"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_week.push(item.total)
          $scope.register_report_week.push(item.time)
        })

        var ctx = document.getElementById("week_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'horizontalBar',
          data: {
            datasets: [{
              label: 'จำนวนลูกค้า',
              data: $scope.total_report_week,
              backgroundColor: "#ca82f8",
            }],
            labels: $scope.register_report_week,
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

      $http.post("<?php echo base_url("Report/fetchReportByMonth"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_month.push(item.total)
          $scope.register_report_month.push(item.time)
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

      $http.post("<?php echo base_url("Report/fetchReportByYear"); ?>").then(function(response) {
        response.data.map(item => {
          $scope.total_report_year.push(item.total)
          $scope.register_report_year.push(item.time)
        })

        var ctx = document.getElementById("year_chart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'horizontalBar',
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
      $scope.total_report_old_cust = [];
      $scope.register_report_old_cust = [];

      $http.post("<?php echo base_url("Report/fetchReportByoldCust"); ?>").then(function(response) {
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

    $scope._search_custom = function() {
      $scope.total_report_custom = [];
      $scope.register_report_custom = [];

      if ($scope.date_start == undefined || $scope.date_end == undefined) {
        Swal.fire({
          title: 'กรุณาเลือกวันที่ให้ครบ !',
          icon: 'warning',
        })
      } else {
        $http.post("<?php echo base_url("Report/fetchReportByCustom"); ?>", {
          'date_start': $scope.date_start.toISOString().slice(0, 10),
          'date_end': $scope.date_end.toISOString().slice(0, 10),
        }).then(function(response) {
          if (!response.data) {
            Swal.fire({
              title: 'ขออภัย ไม่พบข้อมูล !',
              icon: 'error',
            }).then(function() {
              $scope._fetchData()
            })
          } else {
            response.data.map(item => {
              $scope.total_report_custom.push(item.total)
              $scope.register_report_custom.push(item.register_time)
            })
            var ctx = document.getElementById("custom_chart").getContext('2d');
            var myChart = new Chart(ctx, {
              type: 'horizontalBar',
              data: {
                datasets: [{
                  label: 'จำนวนลูกค้า',
                  data: $scope.total_report_custom,
                  backgroundColor: "#ca82f8",
                }],
                labels: $scope.register_report_custom,
                borderWidth: 1,
              },
              options: {
                responsive: true
              },
            });
          }
        });
      }
    }

    $scope._export_csv = function(type) {
      location.href = "<?php echo base_url('Report/export_data?') ?>" + "type=" + type;
    }

    $scope._export_hist = function(type) {
      location.href = "<?php echo base_url('Report/export_hist_cust?') ?>";
    }
    $scope._export_csv_custom = function() {
      $scope.d_start = $scope.date_start.toISOString().slice(0, 10),
        $scope.d_end = $scope.date_end.toISOString().slice(0, 10),
        location.href = "<?php echo base_url('Report/export_data_custom?') ?>" + "date_start=" + $scope.d_start + "&date_end=" + $scope.d_end;
    }
  })

  function select_view(e) {
    var select = e.value;

    if (select === "stat_customer") {
      document.getElementById('stat_customer').style.display = "block";
      document.getElementById('stat_old_customer').style.display = "none";
      document.getElementById('stat_custom').style.display = "none";

    } else if (select === "stat_old_customer") {
      document.getElementById('stat_customer').style.display = "none";
      document.getElementById('stat_old_customer').style.display = "block";
      document.getElementById('stat_custom').style.display = "none";

    } else if (select === "stat_custom") {
      document.getElementById('stat_customer').style.display = "none";
      document.getElementById('stat_old_customer').style.display = "none";
      document.getElementById('stat_custom').style.display = "block";

    }
  }
</script>