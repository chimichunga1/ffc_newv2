<?php
require_once("../support/config.php");

if(!isLoggedIn()){
    toLogin();
    die();
}

if(!AllowUser(array(1))){
  redirect("index.php");
}


if(!empty($_GET['date_start']))
{
    $date_start=date_create($_GET['date_start']);
}else
{
    $date_start="";
}
if(!empty($_GET['date_end']))
{
    $date_end=date_create($_GET['date_end']);
    date_add($date_end,date_interval_create_from_date_string('1 days'));
}else
{
    $date_end="";
}
makeHead("Audit Log",1);
?>

<?php
require_once("../template/header.php");
require_once("../template/sidebar.php");
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1 class="text-blue">
          Audit Logs
      </h1>

      <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active">Audit Logs</li>
      </ol>
  </section>



  <section class="content">


    <div class="row">
        <div class='col-md-12'>
            <div class="box box-primary">

              <div class="box-header with-border">
                <?php Alert(); ?>
                <div class="col-md-12 col-md-offset-8">
                    <a href="archive_audit_log.php" class="btn btn-flat btn-danger" onclick="return confirm('Are you sure you want to archive the audit logs?')"><span class="fa fa-archive"></span> Archive Audit Log</a>

                    <a href="view_archive_audit_log.php" class="btn btn-flat btn-primary"><span class="fa fa-search"></span> View Archived</a>
                    <span class="clearfix"></span>
                    
                </div>
            </div>
            <div class="box-body">

                <div class="row">
                    <div class='col-sm-12'>
                        <br/>
                        <form method='get'>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class='col-md-3 text-right' >Start Date</label>
                                    <div class='col-md-3'>
                                        <input type='text' name='date_start' class='form-control date_picker' id='date_start' value='<?php echo !empty($_GET['date_start'])?htmlspecialchars($_GET['date_start']):''?>'>
                                    </div>
                                    <label class='col-md-2  text-right' >End Date</label>
                                    <div class='col-md-3'>
                                        <input type='text' name='date_end' class='form-control date_picker' id='date_end' value='<?php echo !empty($_GET['date_end'])?htmlspecialchars($_GET['date_end']):''?>'>
                                    </div>

                                </div>
                            </div>
                            <br/>
                            <div class="row">
                             
                                <div class='col-md-12 text-center'>
                                    <button type='submit'  class=' btn btn-primary btn-flat' >Filter</button>
                                    <button type="button" class='btn-flat btn' onclick="resetFilter()" >Clear</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-12">
                        <table id='ResultTable' class='table table-bordered table-striped'>
                            <thead>
                                <tr>
                                    <th class='text-center'>Employee</th>
                                    <th class='text-center'>Action</th>
                                    <th class='text-center date-td'>Date</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
        </div>
    </div>
</div><!-- /.row -->
</section><!-- /.content -->
</div>
<script type="text/javascript">
  $(function () {
    $('#ResultTable').DataTable({
        "scrollX": true,
        "ajax":"audit_log.txt",
        "dataSrc": "",
        "order": [[ 2, "desc" ]],
        "deferRender": true,
        dom: 'Blrtip',
        buttons: [
        {
            className: 'pns',
            extend:"excel",
            text:"<span class='fa fa-download'></span> Download as Excel File "
        }
        ]
    });

      
        

    $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {

          var min = Date.parse( '<?php echo !empty($date_start)?date_format($date_start,"Y/m/d"):'';?>' );
          var max = Date.parse( '<?php echo !empty($date_end)?date_format($date_end,"Y/m/d"):'';?>' );
              var age = Date.parse( data[2] ) || 0; // use data for the age column

              if ( ( isNaN( min ) && isNaN( max ) ) ||
               ( isNaN( min ) && age <= max ) ||
               ( min <= age   && isNaN( max ) ) ||
               ( min <= age   && age <= max ) )
              {
                  return true;
              }
              return false;
          }
          );

});
</script>
<script type="text/javascript">
  function resetFilter(){
        $("#date_start").val('');
        $("#date_end").val('');
    }
</script>
<?php
Modal();
makeFoot(WEBAPP,1);
?>