<?php
	require_once('../../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
	

		array( 'db' => 'client_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'bor_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'app_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		
		array(
        'db'        => 'id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
            $action_buttons="";
              
            $action_buttons.=" <a href='view_ass_or.php?id={$d}' class='btn btn-primary' data-placement='top' title='View Info'><i class='fa fa-search'> </i></a> ";

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

		$filter_sql=" ll.is_deleted=0 ";
		$whereAll=" " ;
		

	if(!empty($_GET['account_id']))
	{
		$emp=" ll.id=:account_id ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'account_id','val'=>$_GET['account_id'],'type'=>0);
		$filter_sql.=$emp;
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
$complete_query="SELECT ll.id,app_no,client_no,CONCAT(last_name,', ',first_name) AS bor_name,ll.client_no,ll.app_no,ll.loan_status_id, ll.loan_type_id, ls.name as loan_status, lt.name as lt_name,date_applied,ll.is_deleted 
FROM loan_list ll 
INNER JOIN loan_approval_type lt ON lt.id=ll.id 
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