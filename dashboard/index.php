<?php
require_once("../support/config.php");
if(!isLoggedIn()){
  toLogin();
  die();
}

if($_SESSION[WEBAPP]['user']['question_id']==null){
  redirect("logout.php");
  die();
}

makeHead('FFC',1);
$client=$con->myQuery("SELECT COUNT(client_number) as total FROM client_list WHERE is_deleted='0' AND status_id='0'")->fetch(PDO::FETCH_ASSOC);

$block_client=$con->myQuery("SELECT COUNT(client_number) as total FROM client_list WHERE is_deleted='1'")->fetch(PDO::FETCH_ASSOC);

$active_user=$con->myQuery("SELECT COUNT(user_id) as total FROM users WHERE is_deleted='0' AND is_active='1'")->fetch(PDO::FETCH_ASSOC);
$deac_user=$con->myQuery("SELECT COUNT(user_id) as total FROM users WHERE is_deleted='0' AND is_active='0'")->fetch(PDO::FETCH_ASSOC);


$quote=$con->myQuery("SELECT * FROM quotes  ORDER BY RAND() LIMIT 1")->fetch(PDO::FETCH_ASSOC);


?>

<?php
require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1 class='page-header text-center text-primary'>
      Dashboard
    </h1>
  </section>
  <div class='col-md-12'>
    <?php
    Alert();
    ?>
  </div>
  <!-- Main content -->
  <section class="content">


    <div class = "row">

      <div class = "col-md-12">
        <div class= "box box-primary">
          <div class="box-header with-border">

          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <!-- <div class="col-lg-3 col-md-4 col-xs-6">

                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3><?php echo $noOfRooms['no_rooms']; ?></h3>
                    <p>WALA PA</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-list-ul"></i>
                  </div>
                  <a href="list_room.php" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div> -->
              <div class="col-md-6">
             
                        <div class="box box-warning">
                            <div class="box-header with-border">
                              <h3 class="box-title">Latest Users</h3>
                              <?php $user=$con->myQuery("SELECT COUNT(user_id) as total FROM users WHERE is_active='1'")->fetch(PDO::FETCH_ASSOC); ?>

                              <div class="box-tools pull-right">
                                  <span class="label label-primary"><?php echo $user['total']; ?> New Members</span>
                                  <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                                  </button> -->
                              </div>
                            </div>

                           
                            <!-- /.box-header -->
                            <div class="box-body no-padding">
                              <ul class="users-list clearfix">
                                <?php
                                  $user_no=$con->myQuery("SELECT u.user_id, u.first_name, u.last_name, u.image, u.user_type_id, ut.user_type FROM users u
                                  INNER JOIN user_types ut ON u.user_type_id=ut.user_type_id
                                  WHERE is_active='1' ORDER BY u.`user_id` DESC");

                                  while($row=$user_no->fetch(PDO::FETCH_ASSOC)):
                                ?>
                                              <li>
                                            
                                              <img src="../administrator/user_image/<?php echo $row['image']; ?>" style="width:100px;height:80px;">
                                            
                                              <a class="users-list-name" href="#"><?php echo $row['first_name']." ".$row['last_name']; ?></a>
                                              <span class="users-list-date"><?php echo $row['user_type']; ?></span>
                                              </li>
                                <?php 
                                  endwhile; 
                                ?>
                                  
                              </ul>
                          
                            </div>
                           
                            <div class="box-footer text-center">
                              <a href="../administrator/view_users.php" class="uppercase">View All Users</a>
                            </div>
                            <!-- /.box-footer -->
                        </div>
                        <!--/.box -->
              </div>
              <div class="col-lg-3 col-md-4 col-xs-6">

                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3><?php echo $client['total']; ?></h3>
                    <p>Official Client</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <a href="../inquiry/inquiry.php" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 col-xs-6">

                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3><?php echo $block_client['total']; ?></h3>
                    <p>Black List Client</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-user"></i>
                  </div>
                  <a href="../inquiry/inquiry.php" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 col-xs-6">

                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3><?php echo $active_user['total']; ?></h3>
                    <p>System Active Users</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <a href="../administrator/view_users.php" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 col-xs-6">

                <div class="small-box bg-blue">
                  <div class="inner">
                    <h3><?php echo $deac_user['total']; ?></h3>
                    <p>Deactivated Users</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-users"></i>
                  </div>
                  <a href="../administrator/view_users.php" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-md-6">
             
                <div class="box-header with-border">
                  <h3 class="box-title">Random Quote</h3>
                  <div class="box-tools pull-right">
                  <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->

                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <i><?php echo $quote['quote']; ?></i>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            
            </div>
            

            <div class="col-md-12">
                        <div class="panel-body">
                            <div id="morris-area-chart" style="display:none;"></div>
                        </div>
            
                          <div class="box box-warning">
                            <div class="box-header with-border">
                              <h3 class="box-title">Client List</h3>
                              <?php $client=$con->myQuery("SELECT * FROM client_list"); ?>

                              <div class="box-tools pull-right">
                                  <span class="label label-primary">Information</span>
                                      
                              </div>
                            </div>
                            <div class="row">
                              <div class="box-body">
                                  <table id='dataTables' class="table responsive-table table-bordered table-striped" >
                                      <thead>
                                          <tr >
                                              <th>Client No.</th>
                                              <th>Borrower Name</th>
                                             
                                              <th>Email</th>
                                              <th>Date Applied</th>
                                            
                                              <th>Status</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <!-- <tr class="tableheader"> -->
                                        <?php while($row=$client->fetch(PDO::FETCH_ASSOC)): ?>
                                          <tr>  
                                              <td><?php echo $row['client_number']; ?></td>
                                              <td><?php echo $row['fname']." ". $row['mname']." ". $row['lname']; ?></td>
                                              <td><?php echo $row['email']; ?></td>
                                              <td><?php echo $row['applied_date']; ?></td>
                                              <td><?php if ($row['is_deleted'] == '0'): echo "Active"; else: echo "Deleted"; endif; ?></td>
                                          </tr>
                                        <?php endwhile; ?>
                                      </tbody>
                                  </table>
                              </div>
                            </div>
            </div>
           
          </div>
        </div>
      </div> 
    </div>



</section><!-- /.content -->
</div>
<script>
    var dttable="";
      $(document).ready(function() {
        dttable=$('#dataTables').DataTable({
                //"scrollY":"400px",
                "scrollX":"100%",
                "searching": true,
               
              
        });
        
    });
    
</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>

