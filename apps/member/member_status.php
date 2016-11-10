<?php
if(isset($_GET['id'])){
$query = $db->prepare("UPDATE tb_member SET status_member = 0 WHERE tb_member.id_member = :id; ");
$result = $query->execute([
    'id' => $_GET['id'],
]);
  if($result){
    echo "<script>
      alert('Block Success');
      window.location = 'home.php?file=member/index';
    </script>";
  }else{
    echo "<script>
      alert('Block Fail');
      window.location = 'home.php?file=member/index';
    </script>";
  }
}
// สถานะที่เอาไปแสดง
return [
  0 => 'Block',
  1 => 'Activate',
  2 => 'Waiting..',
];
?>
