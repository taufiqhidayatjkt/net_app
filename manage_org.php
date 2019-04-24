<?php
include_once('db_function/funct_org.php');
$submitted = filter_input(INPUT_POST, 'btnSubmit');
$act = filter_input(INPUT_GET,"act");
$id = filter_input(INPUT_GET,"id");

if (isset($submitted)) {
  $nama = filter_input(INPUT_POST,'txtNama');
  if (isset($act) && $act=='edit' && !empty($id)) {
    updateOrgData($nama,$id);
    header("Location: index.php?mn=org");
  }else{
    addOrgData($nama);
  }
}

$data = array();
$nama = "";
if(isset($act) && $act=="del"){
  delOrgData($id);
  header("Location: index.php?mn=org");
}elseif ($act=='edit') {
  $data =  editOrgData($id);
  $nama = $data['nama'];
}

?>

<form class="form-horizontal" method="post">
  <fieldset>
  <legend>Form Tambah Organisasi</legend>
  <div class="form-group">
    <label for="txtNama" class="control-label col-xs-4">Nama Organisasi</label>
    <div class="col-xs-4">
      <input id="txtNama" name="txtNama" type="text" required="required" class="form-control" autofocus placeholder="e.g. BPD" value="<?php echo $nama;?>">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-xs-offset-4 col-xs-8">
      <button name="btnSubmit" type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </div>
  </fieldset>
</form>


<table class="table table-striped table-bordered table-hover" id="example">
  <thead>
    <tr style="background:#ddd">
    <th width="2%">NO</th>
    <th>NAMA</th>
    <th width="15%">AKSI</th>
  </tr>
  </thead>
  <tbody>

<?php
$result = viewOrgData();
  $no=1 ;
    foreach ($result as $key => $value) {

      $link_del = "<a class='btn btn-warning btn-xs' href='index.php?mn=org&act=edit&id=".$value['id']."'>ubah</a>";
      $link_edit = "<button class='btn btn-danger btn-xs' onclick='javascript:delOrgData(".$value['id'].");'>hapus</button>";
      echo '<tr>
              <td>'.$no++.'</td>
              <td>'.$value['nama'].'</td>
              <td>'.$link_del.' '.$link_edit.'</td>
            </tr>';
    }
    // mysqli_free_result($result); // for free memory
    // mysqli_close($conn);
?>

  </tbody>
</table>
