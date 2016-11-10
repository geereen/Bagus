<?php
if(isset($_GET['id'])){
  $target_dir = "D:/xampp/htdocs/Bagus/images/deliveryman/";
  unlink($target_dir.$_GET['old_pic']); //ลบรูปทิ้ง
  //echo $_GET['old_pic'];

  $query = $db->prepare("DELETE FROM tb_staff WHERE id_staff = :id");
  $result = $query->execute([
    'id' => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('Delete Success');
      window.location = 'home.php?file=deliveryman/index';
    </script>";
  }else{
    echo "<script>
      alert('Delete Fail');
      window.location = 'home.php?file=deliveryman/index';
    </script>";
  }
}
?>
