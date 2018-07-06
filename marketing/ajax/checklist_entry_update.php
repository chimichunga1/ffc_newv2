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
			global $con;
			$auth = $con->myQuery("SELECT * FROM client_requirements_cf WHERE application_no=:app_no AND status='pending' AND is_deleted =0",array('app_no'=>$row['app_no']))->fetch(PDO::FETCH_ASSOC);
			$val =""; 
			if($auth > 0){
				 $val = "disabled";
			 }
			if($row['loan_status_id']=='8'){
				
					$action_buttons.="<form method='post' action='../move_credit_approval.php' style='display: inline' onsubmit='return confirm(\"Approve This Request?\")'>";
				$action_buttons.="<input type='hidden' name='id' value={$row['id']}>";
				$action_buttons.="<input type='hidden' name='type' value='submit_credit_approval'>";
				$action_buttons.="<button type='submit' class='btn btn-success' data-toggle='tooltip' data-placement='left' name='action' title='Approve Request' {$val}><i class='fa fa-check'></i></button> ";
				$action_buttons.="</form>";
				$action_buttons.=" <button type='submit' class='btn bg-yellow' id='btn-edit' data-toggle='tooltip' data-placement='left' title='Edit Checklist' name='btnedit' onclick='edit({$d});'><i class='fa fa-edit'> </i></button> ";
				$action_buttons.="<form method='post' action='../move_credit_approval.php' style='display: inline' onsubmit='return confirm(\"Redo This Request?\")'>";
				$action_buttons.="<input type='hidden' name='id' value={$row['id']}>";
				$action_buttons.="<input type='hidden' name='type' value='submit_credit_approval1'>";
				$action_buttons.= "<button type='submit' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='left' title='Redo Request'><i class='fa fa-rotate-left'> </i></button>";
				$action_buttons.="</form>";
			}
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
		$whereAll="ll.is_deleted=0 AND ll.loan_status_id='8'" ;
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