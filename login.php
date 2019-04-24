<?php
include_once('koneksi.php');
include_once('db_function/funct_pegawai.php');
connect();
$submitted = filter_input(INPUT_POST,'login');
$pesan = '';
if (isset($submitted)) {
  // code...
  $username = filter_input(INPUT_POST,'username');
  $password = filter_input(INPUT_POST,'password');
  $result = login($username,$password);
  if($result['nip']){
    $_SESSION['user_log'] = TRUE;
    $_SESSION['user_nip'] = $result['nip'];
    $_SESSION['user_nama'] = $result['nama_depan'].' '.$result['nama_belakang'];
    header('location:index.php');
  }else {
    $pesan = '<div class="alert alert-danger">User tidak terdaftar!</div>';
  }
}
?>
<div class="login">
  <div class="row">
    <div class="col-lg-12 col-md-8">
      <div class="login-form">
        <form method="post">
            <h2 class="text-center">Log in</h2>
            <?php echo $pesan;?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
