<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #3490de;">
          <h5 class="m-0 text-white">เพิ่มพนักงาน</h5>
        </div>
        <div class="card-body">
          <form method="POST" onsubmit="return check();" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class=" row">
              <div class="col-12">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="device_code">รหัสบัตรประชาชน <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : 123465</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="device_code">ชื่อ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : ใจดี</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="device_code">นามสกุล <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : ดีใจ</small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label for="device_code">เบอร์โทรศัพท์ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : 0930000000</small>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="device_code">ชื่อผู้ใช้ <b style="color: #f73859;">*</b> </label>
                      <input type="text" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : xxxxxxxx</small>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="device_code">รหัสผ่าน <b style="color: #f73859;">*</b> </label>
                      <input type="password" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : xxxxxxx</small>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label for="device_status">ตำแหน่ง <b style="color: #f73859;">*</b> </label>
                      <select class="form-control" name="device_status" id="device_status">
                        <option disabled value="" selected> 一 เลือกตำแหน่ง 一 </option>
                        <?php
                        $status_array = array('พนักงาน',  'เจ้าของร้าน');
                        foreach ($status_array as $item) {
                          echo '<option value="' . $item . '">' . $item . '</option>';
                        } ?>
                      </select>
                      <small id="device_status" class="form-text text-muted">Example : พนักงาน</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer bg-white" style="height: 75px;">
          <button type="submit" name="insert" class="btn btn-primary">บันทึก</button>
          <a href="" type="reset" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>


</div>