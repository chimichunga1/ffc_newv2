<?php
	require_once('../../support/config.php');


	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
		array( 'db' => 'id','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),

		array( 'db' => 'client_name','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'ind_code','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'ind_corp','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'bus_type','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'id','dt' => ++$index,'formatter'=>function($d,$row)
		{
			$type="";
			if($row['is_borrower']=='checked'){
				$type.="<li> Borrower </li>";
			}
			if($row['is_dealer']=='checked'){
				$type.="<li> Dealer </li>";
			}
			if($row['is_salesman']=='checked'){
				$type.="<li> Salesman </li>";
			}
			return $type;
		} ),
		array( 'db' => 'is_blacklisted','dt' => ++$index,'formatter'=>function($d,$row)
		{
			if($row['status_id']=='0'){
				if($row['is_blacklisted']=='0'){
					return "New";
				}elseif($row['is_blacklisted']=='1'){
					return "New (Blacklisted)";
				}
			}elseif($row['status_id']=='1'){
				if($row['is_blacklisted']=='0'){
					return "Old";
				}elseif($row['is_blacklisted']=='1'){
					return "Old (Blacklisted)";
				}
			}
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
            // $action_buttons.=" <button type='submit' class='btn btn-success' id='btn-edit' data-toggle='tooltip' data-placement='top' title='Submit for CI' name='btnedit' onclick='submit({$d});'><i class='fa fa-check'> </i></button> ";
          	$action_buttons.=" <button type='submit' class='btn bg-yellow' id='btn-edit' data-toggle='tooltip' data-placement='top' title='Edit Loan' name='btnedit' onclick='edit({$d});'><i class='fa fa-edit'> </i></button> ";
			$action_buttons.= " <button type='submit' class='btn bg-gray' id='btn-print' name='btnprint' data-toggle='tooltip' data-placement='top' title='Print' onclick='submit({$d});'> <i class='fa fa-print'> </i></button>";
			if($row['is_blacklisted']=='0'){
			$action_buttons.= " <button type='submit' class='btn btn-danger' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete' onclick='archive({$d});'><i class='fa fa-remove'> </i></button>";
			}elseif($row['is_blacklisted']=='1'){
			$action_buttons.= " <button type='submit' class='btn btn-success' id='btn-archive' name='btnarchive' data-toggle='tooltip' data-placement='top' title='Delete' onclick='archive({$d});'><i class='fa fa-check'> </i></button>";
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
		$whereAll="";
		$whereResult="";

		$filter_sql="";
		$whereAll="cl.is_deleted=0" ;
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
$complete_query="SELECT cl.client_number AS id,CONCAT(cl.lname,', ',cl.fname,' ',cl.mname) AS client_name,
ic.name AS ind_corp,id.name AS ind_code,bt.name AS bus_type,status_id,is_blacklisted,is_borrower,is_salesman,is_dealer
FROM client_list cl JOIN industry_corp ic ON ic.id=cl.ind_corp_id
JOIN industry_code id ON id.id=cl.ind_code_id
JOIN business_type bt ON bt.id=cl.bus_type_id
JOIN country c ON c.id=cl.country_id
JOIN region r ON r.id=cl.region_id
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
