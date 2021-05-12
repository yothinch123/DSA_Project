<?php
$this->load->view('_layout/header');
?>

<body onload="_login()">
</body>

<script>
  function _login() {
    Swal.fire({
      title: "เซสชั่นหมดอายุ กรุณาเข้าสู่ระบบ !",
      icon: 'warning',
      confirmButtonText: 'ตกลง',
    }).then(() => {
      location.href = '<?php echo base_url("index.php/Base"); ?>';
    })
  }
</script>