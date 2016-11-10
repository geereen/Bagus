<?php
if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM tb_member WHERE id_member = :id");
  $result = $query->execute([
    'id' => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('Delete Success');
      window.location = 'home.php?file=member/index';
    </script>";
  }else{
    echo "<script>
      alert('Delete Fail');
      window.location = 'home.php?file=member/index';
    </script>";
  }
}
//echo $_GET['id'];
?>
