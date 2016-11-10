<?php
if(isset($_GET['id'])){
  $query = $db->prepare("DELETE FROM tb_order WHERE id_order = :id");
  $query->execute([
    'id' => $_GET['id'],
  ]);
  $query = $db->prepare("DELETE FROM tb_orderdetail WHERE tb_orderdetail.id_order = :id");
  $result = $query->execute([
    'id' => $_GET['id'],
  ]);
  if($result){
    echo "<script>
      alert('Delete Success');
      window.location = 'home.php?file=order/index';
    </script>";
  }else{
    echo "<script>
      alert('Delete Fail');
      window.location = 'home.php?file=order/index';
    </script>";
  }
}
//echo $_GET['id'];
?>
