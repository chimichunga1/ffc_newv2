<?php
	require_once('../../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;
	$user_id=$_SESSION[WEBAPP]['user']['user_id'];
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
		array( 'db' => 'ci_by','dt' => ++$index,'formatter'=>function($d,$row)
		{	
			global $con;
			$ciName = $con->myQuery("SELECT CONCAT(last_name, ', ' ,first_name , ' ', middle_initial ) as fullName FROM users WHERE user_id = :userId",array('userId' => $d))->fetch();
			$print = 'For Checking';
			if($d != 0){
				$print = $ciName['fullName'];
			}
			return htmlspecialchars($print);
		} ),
		array(
        'db'        => 'id',
        'dt'        => ++$index,
		'formatter' => function( $d, $row ) 
        {
			global $con;
			$visibility = '';
			// $auth = $con->myQuery("SELECT * FROM loan_list WHERE id={$row['id']} AND is_deleted=0")->fetch(PDO::FETCH_ASSOC);
			// 	$dataIn = array(
			// 		'app_no' => $row['id'],
			// 		'client_no' => $auth['client_no']
			// 	);
			
			// $visibility = ($auth['loan_status_id'] == 5)?'':'disabled';
            $action_buttons="";
            $action_buttons.="<form method='post' action='../move_loan.php' style='display: inline' onsubmit='return confirm(\"Approve This Request?\")'>";
            $action_buttons.="<input type='hidden' name='id' value={$row['id']}>";
            $action_buttons.="<input type='hidden' name='type' value='submit_mark'>";
            $action_buttons.="<button type='submit' class='btn btn-success' data-toggle='tooltip' data-placement='top' name='action' title='Approve Request' {$visibility}><i class='fa fa-check'></i></button> ";
			$action_buttons.="</form>";
			// $action_buttons.="<input type='hidden' name='emp_id' value={$row['employee_id']}>";
			$action_buttons.=" <button type='submit' class='btn bg-yellow' id='btn-edit' data-toggle='tooltip' data-placement='top' title='Edit Loan' name='btnedit' onclick='edit({$d});'><i class='fa fa-edit'> </i></button> ";
			// $action_buttons.="<input type='hidden' name='emp_id' value={$row['employee_id']}>";
			$action_buttons.="<form method='post' action='../move_loan.php' style='display: inline' onsubmit='return confirm(\"Redo This Request?\")'>";
            $action_buttons.="<input type='hidden' name='id' value={$row['id']}>";
            $action_buttons.="<input type='hidden' name='type' value='submit_mark1'>";
			$action_buttons.= "<button type='submit' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete'><i class='fa fa-rotate-left'> </i></button>";
			$action_buttons.="</form>";
			// if($row['loan_status_id']=='3'){
			// $action_buttons.= " <button type='submit' class='btn bg-gray' id='btn-print' name='btnprint' data-toggle='tooltip' data-placement='top' title='Print' onclick='submit({$d});'> <i class='fa fa-print'> </i></button>";
			// }
                //reject(\"{$row['id']}\")   --------- forApprovalDetails.php?id={$d}
            return $action_buttons;


        }
    ),
	);
	require( '../../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="";
		$whereAll="ll.is_deleted=0 AND ll.loan_status_id='3'  AND (ll.ci_check_by='0' OR ll.ci_check_by='$user_id')" ;
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
$bindings=jp_bind($bindings);
$complete_query="SELECT ll.id,app_no,ll.ci_check_by AS ci_by,client_no,CONCAT(last_name,', ',first_name) AS bor_name,
/*(SELECT CONCAT(u.last_name,', ',u.first_name,' ',u.middle_initial) FROM users u WHERE u.user_id=ll.ci_check_by) AS ci_by,*/ll.loan_status_id, ls.name as loan_status, 
lt.name as lt_name,date_applied,ll.is_deleted 
FROM loan_list ll 
INNER JOIN loan_approval_type lt ON lt.id=ll.loan_type_id 
INNER JOIN loan_status ls ON ll.loan_status_id=ls.id
{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();




$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal'] = $recordsFiltered;
$json['recordsFiltered']=$recordsFiltered;
$json['data']=SSP::data_output($columns,$data);



echo json_encode($json);
	die;
?>