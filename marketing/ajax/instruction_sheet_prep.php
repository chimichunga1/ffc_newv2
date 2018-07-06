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
			global $con;
			$visibility = false;
			// $download = $con->myQuery("SELECT * FROM instruction_info WHERE application_no = :app_no AND client_no = :client_no",array(
			// 	'app_no' => $row['id'],
			// 	'client_no' => $row['client_no']
			// ));
			// print_r($row);
			// die();

			
			$addon = AddonList();	

			if(in_array($row['loan_type_id'],$addon)){
				$auth = $con->myQuery("SELECT * FROM instruction_sheet WHERE ll_id = :id AND client_no = :client_no AND is_deleted = 0",array('id'=>$row['id'],'client_no'=>$row['client_no']))->fetchColumn();
				if($auth > 0){
					$visibility = true;
				$action = './addon_print.php';
				$token = $con->myQuery("SELECT * FROM instruction_sheet WHERE ll_id = :id AND client_no = :client_no AND is_deleted = 0",array('id'=>$row['id'],'client_no'=>$row['client_no']))->fetch(PDO::FETCH_ASSOC);
				$tbl_id = $token['id'] ;	
				}
			}

			if(in_array($row['loan_type_id'],array(6))){
				$auth = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE ll_id = :id AND client_no = :client_no AND is_deleted = 0",array('id'=>$row['id'],'client_no'=>$row['client_no']))->fetchColumn();
				if($auth > 0){
					$visibility = true;
				$action = './td_print.php';
				$token = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE ll_id = :id AND client_no = :client_no AND is_deleted = 0",array('id'=>$row['id'],'client_no'=>$row['client_no']))->fetch(PDO::FETCH_ASSOC);
				$tbl_id = $token['id'] ;	
				}
			}
			if(in_array($row['loan_type_id'],array(2))){}
			if(in_array($row['loan_type_id'],array(3))){}			

            $action_buttons="";
			if($row['loan_status_id']=='9'){
				// $action_buttons.=" <button type='submit' class='btn bg-grey' id='btn-print' data-toggle='tooltip' data-placement='left' title='Print Inst. Sheet' name='btnprint' onclick='#'><i class='fa fa-download'> </i></button> ";
				$action_buttons.=" <button type='submit' class='btn bg-yellow' id='btn-edit' data-toggle='tooltip' data-placement='left' title='Edit Inst. Sheet' name='btnedit' onclick='edit({$d});'><i class='fa fa-edit'> </i></button> ";
					if($visibility){
						$action_buttons.="<form method='post' action='{$action}' target='_blank' style='display: inline'>";
						$action_buttons.="<input type='hidden' name='tbl_id' value='{$tbl_id}'>";
						$action_buttons.="<button type='submit' class='btn bg-grey ' data-toggle='tooltip' data-placement='left' name='action' title='Print Inst. Sheet'><i class='fa fa-print'></i></button> ";
						$action_buttons.="</form>";
					}
					$action_buttons.="<form method='post' action='../move_credit_approval.php' style='display: inline' onsubmit='return confirm(\"Redo This Request?\")'>";
					$action_buttons.="<input type='hidden' name='id' value={$row['id']}>";
					$action_buttons.="<input type='hidden' name='type' value='submit_instruction_redo'>";
					$action_buttons.="<button type='submit' class='btn btn-danger' data-toggle='tooltip' data-placement='left' name='action' title='Redo Request'><i class='fa fa-rotate-left'></i></button> ";
					$action_buttons.="</form>";
				
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
		$whereAll="ll.is_deleted=0 AND ll.loan_status_id='9'" ;
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
$order = "ORDER BY ll.date_applied desc";
$bindings=jp_bind($bindings);
$complete_query="SELECT ll.id,ll.loan_type_id,app_no,client_no,CONCAT(last_name,', ',first_name) AS bor_name,ll.loan_status_id, ls.name as loan_status, lt.name as lt_name,date_applied,ll.is_deleted 
FROM loan_list ll 
JOIN loan_approval_type lt ON lt.id=ll.loan_type_id 
JOIN loan_status ls ON ll.loan_status_id=ls.id
{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$con->myQuery("SELECT ll.id,ll.loan_type_id,app_no,client_no,CONCAT(last_name,', ',first_name) AS bor_name,ll.loan_status_id, ls.name as loan_status, lt.name as lt_name,date_applied,ll.is_deleted 
FROM loan_list ll 
JOIN loan_approval_type lt ON lt.id=ll.loan_type_id 
JOIN loan_status ls ON ll.loan_status_id=ls.id
WHERE ll.is_deleted = 0 AND ll.loan_status_id = 9
ORDER BY ll.date_applied desc")->rowCount();




$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsFiltered'] = $json['recordsTotal'] = $recordsFiltered;

$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>