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
		array( 'db' => 'bor_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
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
              
          	$action_buttons.=" <a href='view_loan.php?id={$d}' class='btn btn-warning' id='btn-edit' data-toggle='tooltip' data-placement='top' title='View Loan' name='btnedit' ><i class='fa fa-search'> </i></a> ";


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

		$filter_sql=" ll.is_deleted=0 AND is_approve=0 AND loan_status_id =10 ";
		$whereAll=" " ;
		$cj="";

	if(!empty($_GET['status_id']))
	{
		$cj=" loan_status_id=:loan_status_id ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'loan_status_id','val'=>$_GET['status_id'],'type'=>0);
		$filter_sql.=$cj;
	}
	if(!empty($_GET['loan_type_id']))
	{
		$cj=" loan_type_id=:loan_type_id ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'loan_type_id','val'=>$_GET['loan_type_id'],'type'=>0);
		$filter_sql.=$cj;
	}
 
	if(!empty($_GET['client_no']))
	{
		$cj=" client_no=:client_no ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'client_no','val'=>$_GET['client_no'],'type'=>0);
		$filter_sql.=$cj;
	}

	if(!empty($_GET['app_no']))
	{
		$cj=" app_no=:app_no ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'app_no','val'=>$_GET['app_no'],'type'=>0);
		$filter_sql.=$cj;
	}
		if(empty($cj)) {
			
			$filter_sql=" ll.id ='' ";
		}
		
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
$whereAll.=$filter_sql;
$where.= !empty($where) ? " AND ".$whereAll:"WHERE ".$whereAll;
$bindings=jp_bind($bindings);
// var_dump($bindings);
$complete_query="SELECT ll.id,app_no,client_no,CONCAT(ll.last_name,', ',ll.first_name) AS bor_name,ll.current_approver_id,client_no,ll.app_no,ll.loan_status_id, ll.loan_type_id, ls.name as loan_status, lt.name as lt_name,date_applied,ll.is_deleted 
FROM loan_list ll 
INNER JOIN loan_approval_type lt ON lt.id=ll.loan_type_id 
INNER JOIN loan_status ls ON ll.loan_status_id=ls.id

{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(ll.id)
FROM loan_list ll  {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>