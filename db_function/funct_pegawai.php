<?php
function viewPegawaiData(){
  $conn = connect();
  $query = "SELECT *, (select nama from tb_organisasi where id=a.tb_organisasi_id) as nama_org FROM tb_pegawai a ORDER BY nip ASC ";
  $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
  return $result;
}

function addPegawaiData($nip,$namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$username,$password){
  $conn = connect();
  $query = "INSERT INTO tb_pegawai (nip,nama_depan,nama_belakang,jenis_kelamin,tb_organisasi_id,username,password) VALUES (?,?,?,?,?,?,MD5(?))";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"sssiiss", $nip,$namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$username,$password);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

function delPegawaiData($nip){
  $conn = connect();
  $query = "DELETE FROM tb_pegawai WHERE nip=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"s", $nip);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

// function editPegawaiData($id){
//   $conn = connect();
//   $query = "SELECT * FROM tb_pegawai WHERE nip='".$id."'";
//   $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
//   $row = mysqli_fetch_assoc($result);
//   return $row;
// }

function editPegawaiData($id){
  $conn = connect();
  $query = "SELECT * FROM tb_pegawai WHERE nip=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"s",$id);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
  return $row;
}

function updatePegawaiData($namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$username,$password,$nip){
  $conn = connect();
  $query = "UPDATE tb_pegawai SET nama_depan=?, nama_belakang=?, jenis_kelamin=?, tb_organisasi_id=?, username=?, password=MD5(?) WHERE nip=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"ssiisss", $namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$username,$password,$nip);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

function updatePegawaiDataNonAkun($namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$nip){
  $conn = connect();
  $query = "UPDATE tb_pegawai SET nama_depan=?, nama_belakang=?, jenis_kelamin=?, tb_organisasi_id=? WHERE nip=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"ssiis", $namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$nip);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

function login($username,$password){
  $conn = connect();
  $query = "SELECT nip,nama_depan,nama_belakang FROM tb_pegawai WHERE username=? and password=md5(?)";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"ss",$username,$password);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_stmt_bind_result($stmt, $nip, $nama_depan, $nama_belakang);
    mysqli_stmt_fetch($stmt);
    $result = array('nip'=>$nip, 'nama_depan'=>$nama_depan, 'nama_belakang'=>$nama_belakang);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
  return $result;
}
