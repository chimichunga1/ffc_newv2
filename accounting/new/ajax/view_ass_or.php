<?php
	require_once('../../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
	

		array( 'db' => 'payment_type','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'bank','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'check_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'cash','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'cheque','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        
        array( 'db' => 'total','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'details','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
        } ),
        array( 'db' => 'deposit_date','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} )
    
	);
	require( '../../support/ssp.class.php' );

		$limit = SSP::limit( $_GET, $columns );
		$order = SSP::order( $_GET, $columns );

		$where = SSP::filter( $_GET, $columns, $bindings );
		$whereAll="";
		$whereResult="";

		$filter_sql="  ";
		$whereAll=" of.is_deleted=0 " ;
		

	if(!empty($_GET['client_id']))
	{
		$emp=" client_id=:client_id ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'client_id','val'=>$_GET['client_id'],'type'=>0);
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
$complete_query="SELECT of.id, of.client_id, of.payment_type_id, pt.name as payment_type, of.bank_id, b.name as bank, of.details, of.check_no, of.deposit_date, of.cash, of.cheque,of.total, of.is_deleted
FROM official_receipt of
INNER JOIN payment_type pt ON of.payment_type_id=pt.id 
INNER JOIN bank b ON of.bank_id=b.id
{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(of.id)
FROM official_receipt of  {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>