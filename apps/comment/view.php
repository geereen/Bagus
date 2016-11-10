<?php
$query = $db->prepare("SELECT * FROM tb_comment INNER JOIN tb_member ON tb_comment.id_member=tb_member.id_member
                       WHERE id_comment = :id");
$query->execute([
  'id'=>$_GET['id']
]);//รัน sql
$row = $query->fetch(PDO::FETCH_OBJ);
?>
<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=comment/index">
        <span class="fa fa-backward" aria-hidden="true"></span>
      </a>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table class="table">
        <thead>
          <tr>
            <th><h2><?= $row->fullname_member;?></h2></th>
            <th>Date/Time</th>
            <th>Detail</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td><img src="../images/members/<?=$row->pic_member?>" alt="" width="220"/></td>
            <td><?= $row->date_comment;?></td>
            <td><?= $row->detail;?></td>

            <td>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
