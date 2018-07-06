

<?php
	require_once('../../support/config.php');
    
	$primaryKey ='acc_id';
	$index=-1;

	$columns = array(
		array( 'db' => 'bank','dt' => ++$index,'formatter'=>function($d,$row)
		{   global $con;
            $bank = $con->myQuery("SELECT name FROM bank WHERE id = ?",array($d))->fetch(PDO::FETCH_ASSOC);
			return htmlspecialchars($bank['name']);
		} ),

		array( 'db' => 'check_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'amount_sched','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars(floatConvert($d));
		} ),
		array( 'db' => 'maturity_date_sched','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars(inputmask_format_date($d));
		} ),
		array( 'db' => 'term_sched','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		array( 'db' => 'discount','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars(floatConvert($d));
        } ),
        array( 'db' => 'net_proceeds_sched','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars(floatConvert($d));
		} ),
		array(
        'db'        => 'id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
			global $con;
			$client = $con->myQuery("SELECT * FROM instruction_sheet_td WHERE client_no = ? AND app_no = ? AND is_deleted = 0",array($row['client_no'],$row['app_no']))->fetch(PDO::FETCH_ASSOC);
            $action_buttons="";
            $action_buttons .= "<form action='del_sched.php' method='POST' onsubmit='return confirm(\"Delete Element?\")'>
		<a href='instruction_sheet_td.php?id={$client['ll_id']}&tab=2&ee={$row['id']}' class='btn btn-primary' title='Edit Elemet' data-toggle='tooltip' data-placement='left' name='editElement'> <span class='fa fa-pencil-square-o'></span> </a>
			<input type='hidden' name='id' value='{$row['id']}'>
            <input type='hidden' name='idLL' value='{$row['app_no']}'>
            <input type='hidden' name='type' value='del_sched'>
            <button class='btn btn-danger' data-toggle='tooltip' data-placement='left' title='Delete element' name='submit'><span class='fa fa-trash-o'></span></button>
			</form>";
			

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
		$whereAll="app_no = ".$_GET['id']." AND is_deleted = 0" ;
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
$complete_query="SELECT * FROM td_sched
{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered = $con->myQuery("SELECT * FROM td_sched WHERE app_no = ? AND is_deleted = 0",array($_GET['id']))->rowCount();

$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsFiltered'] = $json['recordsTotal'] = $recordsFiltered;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;
?>