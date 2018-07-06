<div class="modal" id='modal_submit'>
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h3 class="modal-title"><center> </h3>
          </div>
          <div class="modal-body" >
          <div align='right'>
          <button onclick='window.print()' class='btn btn-brand no-print'>Print &nbsp;<span class='fa fa-print'></span></button>  
          </div>
          <form method="POST" action='../move_loan.php'>
          <input type='hidden' name='type' id='type' value='submit_ci'>
          <input type='hidden' name='id' id='task_id' value=''>
          <div id="printableArea">
          <div class='' id='comment_table' style=' word-wrap: break-word;'>
            </div>
            </div>
          </div>
            <div class="modal-footer">
             <div class='text-center'>
            <button type="submit" class="btn btn-warning no-print">Submit</button>
            <button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
          </div>
          </div>
          </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <script>
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>