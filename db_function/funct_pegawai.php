<?php
function viewPegawaiData(){
  $conn = connect();
  $query = "SELECT *, (select nama from tb_organisasi where id=a.tb_organisasi_id) as nama_org FROM tb_pegawai a ORDER BY nip ASC ";
  $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
  return $result;
}

function addPegawaiData($nip,$namaDepan,$namaBelakang,$jenisKelamin,$idOrg){
  $conn = connect();
  $query = "INSERT INTO tb_pegawai (nip,nama_depan,nama_belakang,jenis_kelamin,tb_organisasi_id) VALUES (?,?,?,?,?)";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"sssii", $nip,$namaDepan,$namaBelakang,$jenisKelamin,$idOrg);
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

function editPegawaiData($id){
  $conn = connect();
  $query = "SELECT * FROM tb_pegawai WHERE nip='".$id."'";
  $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
  $row = mysqli_fetch_assoc($result);
  return $row;
}

function updatePegawaiData($namaDepan,$namaBelakang,$jenisKelamin,$idOrg,$nip){
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
