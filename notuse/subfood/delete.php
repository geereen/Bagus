<?php
if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM tb_subfood WHERE id_subfood = :id");
  $result = $query->execute([
    'id' => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('Delete Success');
      window.location = 'home.php?file=subfood/index';
    </script>";
  }else{
    echo "<script>
      alert('Delete Fail');
      window.location = 'home.php?file=subfood/index';
    </script>";
  }
}
//echo $_GET['id'];
?>
