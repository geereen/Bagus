<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Comment <small></small></h2>

      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <table id="datatable" class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Date/Time</th>
            <th>Manage</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $query = $db->prepare("SELECT * FROM tb_comment INNER JOIN tb_member ON tb_comment.id_member=tb_member.id_member ORDER BY tb_comment.id_comment ASC");//เตรียมคำสั่ง sql
            $query->execute();//รัน sql
            if($query->rowCount() > 0){ //ตรวจสอบว่ามีข้อมูลมากว่า 0 ไหม
              $i=1;
              while($row = $query->fetch(PDO::FETCH_OBJ)){ // ดึงข้อมูลมาใส่ใน $row
          ?>
          <tr>
            <td><?= $i++?></td>
            <td><?= $row->fullname_member;?></td>
            <td><?= $row->date_comment;?></td>
            <td>
              <a data-toggle="tooltip" data-placement="top" title="View" href="home.php?file=comment/view&id=<?=$row->id_comment?>">
                <span class="fa fa-eye" aria-hidden="true"></span>
              </a>&nbsp;
              <!-- <a data-toggle="tooltip" data-placement="top" title="Reply" href="#">
                <span class="fa fa-commenting-o" aria-hidden="true"></span>
              </a>&nbsp; -->
              <a data-toggle="tooltip" data-placement="top" title="Delete" href="home.php?file=comment/delete&id=<?=$row->id_comment?>">
                <span class="fa fa-trash-o" aria-hidden="true"></span>
              </a>
            </td>
          </tr>
          <?php
            } //  ปิด while
          }// ปิด if
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
