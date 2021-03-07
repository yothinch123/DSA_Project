<div class="container-fluid" id="container-wrapper" style="margin-top: 90px;">
  <div class="row mb-3">
    <div class="col-xl-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #3490de;">
          <h5 class="m-0 text-white">ตั้งค่า Wi-Fi</h5>
        </div>
        <div class="card-body">
          <form method="POST" onsubmit="return check();" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <div class=" row">
              <div class="col-8">
                <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="device_code">รหัสอุปกรณ์ <b class="text-red">*</b> </label>
                      <input type="text" class="form-control" id="device_code" name="device_code" autocomplete="off">
                      <small id="device_code" class="form-text text-muted">Example : 123465</small>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="branch_code">สาขา <b class="text-red">*</b> </label>
                      <select class="form-control" name="branch_code" id="branch_code" onchange="select_branch(this)">
                        <option disabled value="" selected> 一 เลือกสาขา 一 </option>
                      </select>
                      <small id="branch_code" class="form-text text-muted">Example : จุดรวมงาน</small>
                    </div>
                  </div>

                  <div class="col-4">
                    <div class="form-group">
                      <label for="department">แผนก <b class="text-red">*</b> </label>
                      <br>
                      <label class="pt-1 text-red" id="department_default"><b>กรุณาเลือกสาขาก่อน</b> </label>
                      <select class="form-control" name="department" id="department" style="display: none;">
                        <option disabled value="" selected> 一 เลือกแผนก 一 </option>
                      </select>
                      <small id="department" class="form-text text-muted">Example : - </small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="device_type">ประเภทอุปกรณ์ <b class="text-red">*</b> </label>
                      <select class="form-control" name="device_type" id="device_type">
                        <option disabled value="" selected> 一 เลือกประเภทอุปกรณ์ 一 </option>
                        <?php
                        $device_array = array('จอภาพ', 'เครื่องคอมพิวเตอร์', 'เครื่องพิมพ์', 'เครื่องสำรองไฟ', 'อีเทอร์เน็ตมีเดียคอนเวอร์เตอร์', 'เนทเวิร์คฮับ', 'เนทเวิร์คสวิตช์', 'เร้าเตอร์');
                        foreach ($device_array as $item) {
                          echo '<option value="' . $item . '">' . $item . '</option>';
                        } ?>
                      </select>
                      <small id=" device_type" class="form-text text-muted">Example : คอมพิวเตอร์</small>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="device_status">สถานะของอุปกรณ์ <b class="text-red">*</b> </label>
                      <select class="form-control" name="device_status" id="device_status">
                        <option disabled value="" selected> 一 เลือกสถานะ 一 </option>
                        <?php
                        $status_array = array('ใช้งาน', 'อยู่ระหว่างการซ่อม', 'ยุบสภาพ');
                        foreach ($status_array as $item) {
                          echo '<option value="' . $item . '">' . $item . '</option>';
                        } ?>
                      </select>
                      <small id="device_status" class="form-text text-muted">Example : ใช้งาน</small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="detail">รายละเอียด <b class="text-red">*</b> </label>
                      <textarea style="height: 120px;" name="detail" class="form-control" id="detail" aria-label="With textarea" autocomplete="off"></textarea>
                      <small id="detail" class="form-text text-muted">Example : - </small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div>
                  <h4>รูปภาพ</h4>
                  <div style="text-align: center;">
                    <img id="img" src="../vendor/image/default.png" width="50%" height="300px" />
                  </div>
                  <div class="mt-3">
                    <input type="file" class="form-control" name="imageUpload" id="imageUpload" accept="image/png, image/jpeg" onchange="readURL(this);">
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