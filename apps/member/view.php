<?php
$query = $db->prepare("SELECT * FROM tb_member WHERE id_member = :id");
$query->execute([
  'id'=>$_GET['id']
]);//รัน sql
$row = $query->fetch(PDO::FETCH_OBJ);
?>
<div class="col-md-12 col-sm-6 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="home.php?file=member/index">
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
            <th><h2><i class="fa fa-camera-retro" aria-hidden="true"></i> <?= $row->fullname_member;?></h2></th>
            <th><i class="fa fa-map-marker" aria-hidden="true"></i> Address</th>
            <th><i class="fa fa-envelope" aria-hidden="true"></i> E-mail</th>
            <th><i class="fa fa-phone-square" aria-hidden="true"></i> Phone Number</th>
            <th><i class="fa fa-user" aria-hidden="true"></i> Username</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <?php if ($row->pic_member == '') { ?>
              <img src="../images/profile.jpg" alt="" width="220"/>
              <?php }else { ?>
              <img src="../images/members/<?=$row->pic_member?>" alt="" width="220"/>
              <?php } ?>
            </td>
            <td><?= $row->address;?></td>
            <td><?= $row->email;?></td>
            <td><?= $row->tel_member;?></td>
            <td><?= $row->m_username;?></td>
            <td>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
