<?php
include_once('db_function/funct_pegawai.php');
include_once('db_function/funct_org.php');
$submitted = filter_input(INPUT_POST, 'btnSubmit');
$act = filter_input(INPUT_GET,"act");
$id = filter_input(INPUT_GET,"id");
$pesan = "";

if (isset($submitted)) {
  $nip = filter_input(INPUT_POST,'txtNIP');
  $namaDepan = filter_input(INPUT_POST,'txtNamaDepan');
  $namaBelakang = filter_input(INPUT_POST,'txtNamaBelakang');
  $jenisKelamin = filter_input(INPUT_POST,'txtJenisKelamin');
  $username = filter_input(INPUT_POST,'txtUsername');
  $password = filter_input(INPUT_POST,'txtPassword');
  $repassword = filter_input(INPUT_POST,'txtRePassword');
  $idOrg = filter_input(INPUT_POST,'txtIdOrg');

  if (isset($act) && $act=='edit' && !empty($id)) {

    if ($password=='') {
      // code...
      updatePegawaiDataNonAkun($namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$nip);
      header("Location: index.php?mn=pns");
    }else {
      // code...
      if(!empty($password) && $password==$repassword) {
        updatePegawaiData($namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$username,$password,$nip);
        header("Location: index.php?mn=pns");
      }else {
        $pesan = '<div class="alert alert-danger">Password tidak sama!</div>';
      }
    }


  }else{

    $ceknip = editPegawaiData($nip);
    if($ceknip['nip']){
      $pesan = '<div class="alert alert-danger">NIP telah terdaftar!</div>';
    }else {

      if ($password=='') {
        // code...
        $pesan = '<div class="alert alert-danger">Password tidak boleh kosong!</div>';
      }else {
        // code...
        if($password==$repassword) {
          addPegawaiData($nip,$namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$username,$password);
        }else {
          $pesan = '<div class="alert alert-danger">Password tidak sama!</div>';
        }
      }

    }


  }
}

$data = array();
$nama = "";
if(isset($act) && $act=="del"){
  delPegawaiData($id);
  header("Location: index.php?mn=pns");
}elseif ($act=='edit') {
  $data =  editPegawaiData($id);
  $nip = $data['nip'];
  $namaDepan = $data['nama_depan'];
  $namaBelakang = $data['nama_belakang'];
  $jenisKelamin  = $data['jenis_kelamin'];
  $username  = $data['username'];
  $password  = $data['password'];
  $idOrg = $data['tb_organisasi_id'];
}
?>

<form class="form-horizontal" method="post">
  <fieldset>
  <legend>Form Tambah Pegawai</legend>
  <?php echo $pesan;?>
  <div class="form-group">
    <label for="txtNama" class="control-label col-xs-4">NIP</label>
    <div class="col-xs-4">
      <input id="txtNama" name="txtNIP" type="text" required="required" maxlength="19" class="form-control" autofocus value="<?php echo @$nip;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="txtNama" class="control-label col-xs-4">Nama Depan</label>
    <div class="col-xs-4">
      <input id="txtNama" name="txtNamaDepan" type="text" required="required" class="form-control" value="<?php echo @$namaDepan;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="txtNama" class="control-label col-xs-4">Nama Belakang</label>
    <div class="col-xs-4">
      <input id="txtNama" name="txtNamaBelakang" type="text" required="required" class="form-control" value="<?php echo @$namaBelakang;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="txtUsername" class="control-label col-xs-4">Username</label>
    <div class="col-xs-3">
      <input id="txtUsername" name="txtUsername" type="text" required="required" class="form-control" value="<?php echo @$username;?>">
    </div>
  </div>
  <div class="form-group">
    <label for="txtPassword" class="control-label col-xs-4">Password</label>
    <div class="col-xs-3">
      <input id="txtPassword" name="txtPassword" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group">
    <label for="txtRePassword" class="control-label col-xs-4">Ulangi Password</label>
    <div class="col-xs-3">
      <input id="txtRePassword" name="txtRePassword" type="text" class="form-control">
    </div>
  </div>
  <div class="form-group">
      <label for="txtJenisKelamin" class="control-label col-xs-4">Jenis Kelamin</label>
      <div class="col-xs-8">
        <label class="radio-inline">
          <input type="radio" name="txtJenisKelamin" value="1" <?php echo ( (isset($act) && $act=='edit' && $jenisKelamin==1) ? 'checked' : '' ); ?>>
                Laki-laki
        </label>
        <label class="radio-inline">
          <input type="radio" name="txtJenisKelamin" value="0" <?php echo ( (isset($act) && $act=='edit' && $jenisKelamin==0) ? 'checked' : '' ); ?>>
                Perempuan
        </label>
      </div>
    </div>

  <div class="form-group">
    <label for="txtIdOrg" class="control-label col-xs-4">Organisasi</label>
    <div class="col-xs-4">
      <select id="txtIdOrg" name="txtIdOrg" class="select form-control">
        <?php
            $listOrg = viewOrgData();
            $slc = '';
            foreach ($listOrg as $key => $value) {
              $slc = (isset($act) && $act=='edit' && $value['id']==$idOrg) ? "selected" : "" ;
              echo '<option '.$slc.' value="'.$value['id'].'">'.$value['nama'].'</option>';
            }
        ?>
      </select>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-xs-offset-4 col-xs-8">
      <button name="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
  </fieldset>
</form>


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="example" width="99%">
  <thead>
  <tr style="background:#ddd">
    <th width="1%">NO</th>
    <th>NIP</th>
    <th>NAMA LENGKAP</th>
    <th>JENIS KELAMIN</th>
    <th>INSTANSI</th>
    <th>CREATED</th>
    <th>AKSI</th>
  </tr>
  </thead>
  <tbody>

<?php
include_once('db_function/funct_pegawai.php');
$result = viewPegawaiData();
  $no=1;
    foreach ($result as $key => $value) {

        $jekel = ($value['jenis_kelamin']==0) ? 'Perempuan' : 'Laki-laki' ;

        $link_del = "<a class='btn btn-warning btn-xs' href='index.php?mn=pns&act=edit&id=".$value['nip']."'>ubah</a>";
        $link_edit = "<button class='btn btn-danger btn-xs' onclick='javascript:delPegawaiData(".$value['nip'].");'>hapus</button>";

      echo '<tr>
              <td>'.$no++.'</td>
              <td>'.$value['nip'].'</td>
              <td>'.$value['nama_depan'].' '.$value['nama_belakang'].'</td>
              <td>'.$jekel.'</td>
              <td>'.$value['nama_org'].'</td>
              <td>'.$value['created'].'</td>
              <td>'.$link_del.' '.$link_edit.'</td>
            </tr>';
    }
?>

  </tbody>
</table>
</div>
