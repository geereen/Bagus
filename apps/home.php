<?php
session_start();
date_default_timezone_set('Asia/Bangkok'); //เซตทามโซน
require_once("../libs/Db.php"); //ติดต่อฐานข้อมูล
if(!empty($_SESSION['user'])){ //ถ้า Session มีค่าให้แสดงหน้า Home
############# ดึงข้อมูลของ order ใหม่มาเก็บในตัวแปร #############
$query = $db->prepare("SELECT * FROM tb_order INNER JOIN tb_member ON (tb_order.id_member=tb_member.id_member)
                       WHERE tb_order.status = 1 ORDER BY id_order DESC");//เตรียมคำสั่ง sql
$query->execute();
$ord = $query->fetchAll(PDO::FETCH_OBJ);
$i=1;
###########################################################
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <link rel="shortcut icon" href="../images/logo/logo.ico" />
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Bagus Delivery</title>
    <!-- Slide w3schools -->
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    <!-- Bootstrap -->
    <link href="../assets/bootstrap/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../assets/bootstrap/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../assets/bootstrap/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../assets/bootstrap/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../assets/bootstrap/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../assets/bootstrap/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-wysiwyg -->
    <link href="../assets/bootstrap/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../assets/bootstrap/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../assets/bootstrap/vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../assets/bootstrap/vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../assets/bootstrap/build/css/custom.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../assets/bootstrap/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/bootstrap/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- test Font TH Sarabun new -->
    <link rel="stylesheet" href="../fonts/thsarabunnew.css" />
    <!-- test Font TH Sarabun new -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="home.php" class="site_title"><i class="glyphicon glyphicon-home"></i> <span>Admin Bagus</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="../images/admin/<?=$_SESSION['user']['pic']?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?= $_SESSION['user']['name'];?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-users"></i> Members <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="home.php?file=member/index">Views</a></li>
                      <li><a href="home.php?file=member/block">Black List</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-motorcycle"></i> Delivery Man <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="home.php?file=deliveryman/add">Add</a></li>
                      <li><a href="home.php?file=deliveryman/index">Views</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-cutlery"></i> Foods <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="home.php?file=food/add">Add Food</a></li>
                      <li><a href="home.php?file=food/index">Views</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-list-alt"></i> Orders <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="home.php?file=order/index">Views</a></li>
                      <li><a href="home.php?file=order/complete">Complete</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-comment"></i> Comment <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="home.php?file=comment/index">Views</a></li>
                      <!-- <li><a href="#">Reply</a></li> -->
                    </ul>
                  </li>
                  <li><a><i class="fa fa-bell-o"></i> Notification <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!-- <li><a href="home.php?file=notification/map">Map</a></li> -->
                      <li><a href="home.php?file=notification/index">Send Notification</a></li>
                    </ul>
                  </li>
                </ul>
              </div> <!-- menu_section -->
            </div>
            <!-- /sidebar menu -->
            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../images/admin/<?=$_SESSION['user']['pic']?>" alt=""> <?=$_SESSION['user']['username'];?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a href="logout.php" ><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <?php foreach ($ord as $value):?>
                    <span class="badge bg-green"><?= $i++?></span>
                    <?php endforeach;?>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <?php foreach ($ord as $value):?>
                      <a href="home.php?file=order/view&id=<?=$value->id_order?>">
                        <span class="image">
                          <?php if ($value->pic_member == '') { ?>
                          <img src="../images/profile.jpg" alt="Profile Image" />
                          <?php }else { ?>
                          <img src="../images/members/<?= $value->pic_member?>" height="30" alt="Profile Image" />
                          <?php } ?>
                        </span>
                        <span>
                          <span><?= $value->fullname_member?></span>
                          <span class="time">
                            <?= $value->order_date?><br>
                            <?= $value->order_time?>
                          </span>
                        </span>
                        <span class="message">
                          Have a new order.
                        </span>
                      </a>
                      <?php endforeach;?>
                    </li>

                    <li>
                      <div class="text-center">
                        <a href="home.php?file=order/index">
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <!-- /top tiles -->
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <br/>
              <div class="row">

                <?php
                  if(isset($_GET['file'])){
                    $app_file = $_GET['file'].'.php';
                      if(is_file($app_file)){
                        include_once($app_file);
                      }else{
                        echo 'Page Not Found 404';
                      }
                  }else{
                    include_once('slider.php');
                  }
                ?>

              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            ©2016 All Rights Reserved. <a href="https://www.facebook.com/geereen.pk" target="_blank">GeeReen !</a> is a Admin Bagus. Privacy and Terms
            <!-- Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a> -->
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->

      </div> <!-- main_container -->
    </div> <!-- container body -->

    <!-- jQuery -->
    <script src="../assets/bootstrap/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../assets/bootstrap/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../assets/bootstrap/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../assets/bootstrap/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../assets/bootstrap/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../assets/bootstrap/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../assets/bootstrap/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../assets/bootstrap/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../assets/bootstrap/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="../assets/bootstrap/vendors/Flot/jquery.flot.js"></script>
    <script src="../assets/bootstrap/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="../assets/bootstrap/vendors/Flot/jquery.flot.time.js"></script>
    <script src="../assets/bootstrap/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="../assets/bootstrap/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="../assets/bootstrap/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="../assets/bootstrap/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="../assets/bootstrap/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="../assets/bootstrap/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="../assets/bootstrap/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../assets/bootstrap/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../assets/bootstrap/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../assets/bootstrap/production/js/moment/moment.min.js"></script>
    <script src="../assets/bootstrap/production/js/datepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../assets/bootstrap/build/js/custom.min.js"></script>
    <!-- Select2 -->
    <script src="../assets/bootstrap/vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Autosize -->
    <script src="../assets/bootstrap/vendors/autosize/dist/autosize.min.js"></script>
    <!-- starrr -->
    <script src="../assets/bootstrap/vendors/starrr/dist/starrr.js"></script>
    <!-- Datatables -->
    <script src="../assets/bootstrap/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../assets/bootstrap/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="../assets/bootstrap/vendors/jszip/dist/jszip.min.js"></script>
    <script src="../assets/bootstrap/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../assets/bootstrap/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- google map -->
    <!-- <script async defer src="https://maps.google.com/maps/api/js?key=AIzaSyB0v5wyTM98cjgsVrEKynuvO1Ens7aFeqY&v=3.exp&callback=setupMap"></script>
    <script type="text/javascript">
      function setupMap() {
        var bagusLatLng = new google.maps.LatLng(6.86545,101.24106);
        var myOptions = {
          zoom: 13,
          center: bagusLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
        var markerBagus = new google.maps.Marker({
          map: map,
          label: 'A',
          position: bagusLatLng,
        }); // หมุด Bagus
        var contentBagus = "<h4>This Bagus Chicken</h4>";
        var infoWindow = new google.maps.InfoWindow({
          content: contentBagus
        });

        google.maps.event.addListener(markerBagus, 'click', () => {
          infoWindow.open(map, markerBagus);
        });
      }
    </script> -->

    <!-- bootstrap-daterangepicker -->
    <script>
      $(document).ready(function() {
        $('#birthday').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_4"
        }, function(start, end, label) {
          console.log(start.toISOString(), end.toISOString(), label);
        });
      });
    </script>
    <!-- /bootstrap-daterangepicker -->

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_single").select2({
          placeholder: "Select ",
          allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "With Max Selection limit 4",
          allowClear: true
        });
      });
    </script>
    <!-- /Select2 -->

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->

    <!-- Slide w3schools -->
    <script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
           x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 9000);
    }
    </script>

  </body>
</html>
<?php
  }else{ //ถ้า Session ไม่มีค่าให้แสดงหน้า กลับหน้า index
    header('location: ../index.php');
  }
 ?>
 <?php $db = null; //ปิดฐานข้อมูล ?>
