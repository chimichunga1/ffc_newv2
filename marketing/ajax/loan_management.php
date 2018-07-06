<?php
	require_once('../../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
		array( 'db' => 'app_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),

		array( 'db' => 'client_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'client_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			global $con;
			$name=$con->myQuery("SELECT CONCAT(lname,', ',fname,' ',mname) as bor_name FROM client_list WHERE client_number=?",array($row['client_no']))->fetch(PDO::FETCH_ASSOC);
			return htmlspecialchars($name['bor_name']);
		} ),
		array( 'db' => 'lt_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'date_applied','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'loan_status','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array(
        'db'        => 'id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
            $action_buttons="";
                //if loan status = approved but not process
                // another action buttons
                // if($row['approval_status']=="Approved-Undone"):
                //     $action_buttons.="<a class='btn btn-sm btn-success btn-flat' title='Proceeds' href='frm_loan_application.php?tab=2&id={$row['loaner_id']}&u={$row['loan_code']}'><span class='fa fa-arrow-right'></span></a>&nbsp;";
                // else:
                //     $action_buttons.="<a class=' btn btn-sm btn-success btn-flat' title='View Details' href='forApprovalDetails.php?id={$d}'><span class='fa fa-eye'></span></a>&nbsp";
                //     $action_buttons.="<button class='btn btn-sm btn-danger btn-flat'  title='Reject Loan Application' onclick='reject(\"{$row['loan_code']}\")'><span  class='fa fa-close'></span></button>&nbsp;";
				// endif;
					if($row['loan_status_id']=='2')
            $action_buttons.=" <button type='submit' class='btn btn-success' id='btn-edit' data-toggle='tooltip' data-placement='top' title='Submit for CI' name='btnedit' onclick='submit({$d});'><i class='fa fa-check'> </i></button> ";
                  if(AllowUser(array(1,3))&& ($row['loan_status_id']==2)){
          	$action_buttons.=" <button type='submit' class='btn bg-yellow' id='btn-edit' data-toggle='tooltip' data-placement='top' title='Edit Loan' name='btnedit' onclick='edit({$d});'><i class='fa fa-edit'> </i></button> ";
		  }
		  	if($row['loan_status_id']=='2'){
			$action_buttons.= "<button type='submit' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete' onclick='archive({$d});'><i class='fa fa-remove'> </i></button>";
			}if(in_array($row['loan_status_id'] ,array(3,4,5))){
			$action_buttons.= " <button type='submit' class='btn bg-gray' id='btn-print' name='btnprint' data-toggle='tooltip' data-placement='top' title='Print' onclick='submit({$d});'> <i class='fa fa-print'> </i></button>";
			}
                //reject(\"{$row['id']}\")   --------- forApprovalDetails.php?id={$d}
            return $action_buttons;


        }
    ),
	);
	require( '../../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		// $whereAll="";
		$whereResult="";

		$filter_sql="";
		$whereAll="ll.is_deleted=0" ;
		$whereAll.=$filter_sql;
		function jp_bind($bindings)
{
    $return_array=array();
    if ( is_array( $bindings ) ) 
    {
        for ( $i=0, $ien=count($bindings) ; $i<$ien ; $i++ ) 
        {
            //$binding = $bindings[$i];
            // $stmt->bindValueb   	qA@( $binding['key'], $binding['val'], $binding['type'] );
            $return_array[$bindings[$i]['key']]=$bindings[$i]['val'];
        }
    }
    return $return_array;
}
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;
$order = "ORDER BY date_applied desc";
$bindings=jp_bind($bindings);
$complete_query="SELECT ll.id,app_no,client_no,CONCAT(last_name,', ',first_name) AS bor_name,ll.loan_status_id, ls.name as loan_status, lt.name as lt_name,date_applied,ll.is_deleted 
FROM loan_list ll 
JOIN loan_approval_type lt ON lt.id=ll.loan_type_id 
JOIN loan_status ls ON ll.loan_status_id=ls.id
{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();




$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsFiltered;
$json['recordsFiltered']=$recordsFiltered;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>