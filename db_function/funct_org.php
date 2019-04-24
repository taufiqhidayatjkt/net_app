<?php
function viewOrgData(){
  $conn = connect();
  $query = "SELECT * FROM tb_organisasi ORDER BY nama ASC";
  $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
  return $result;
}

function addOrgData($nama){
  $conn = connect();
  $query = "INSERT INTO tb_organisasi (nama) VALUES (?)";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"s", $nama);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}


function delOrgData($id){
  $conn = connect();
  $query = "DELETE FROM tb_organisasi WHERE id=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"s", $id);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}

// function editOrgData($id){
//   $conn = connect();
//   $query = "SELECT * FROM tb_organisasi WHERE id=".$id;
//   $result = mysqli_query($conn,$query) or die (mysqli_error($conn));
//   $row = mysqli_fetch_assoc($result);
//   return $row;
// }

function editOrgData($id){
  $conn = connect();
  $query = "SELECT * FROM tb_organisasi WHERE id=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_stmt_bind_result($stmt, $returnId, $returnNama);
    mysqli_stmt_fetch($stmt);
    $result = array('id'=>$returnId, 'nama'=>$returnNama);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
  return $result;
}

function updateOrgData($nama,$id){
  $conn = connect();
  $query = "UPDATE tb_organisasi SET nama=? WHERE id=?";
  if ($stmt = mysqli_prepare($conn,$query) or die (mysqli_error($conn))) {
    mysqli_stmt_bind_param($stmt,"si", $nama,$id);
    mysqli_stmt_execute($stmt) or die (mysqli_error($conn));
    mysqli_commit($conn);
    mysqli_stmt_close($stmt);
  }
  mysqli_close($conn);
}
