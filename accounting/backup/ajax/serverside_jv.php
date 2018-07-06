<?php
	require_once('../../support/config.php');

		


	$primaryKey ='jv_id';
	$index=-1;



	$columns = array(
		array( 'db' => 'jv_no','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),

	
		array( 'db' => 'clnt_id','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
		
	array( 'db' => 'fullname','dt' => ++$index,'formatter'=>function($d,$row)
		{
			return htmlspecialchars($d);
		} ),
	
		array(
        'db'        => 'jv_no',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
            $action_buttons="";
              
       
	


          	$action_buttons.='   

          				  <a href="jv_gl_valid.php?id='.$d.'" ><button type="button" id="buttonremarks" class="btn btn-success"  data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-check"> </i></button></a>
          	  
                          <a href="jv_gl_edit.php?id='.$d.'" ><button type="button" id="buttonremarks" class="btn btn-warning"  data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"> </i></button></a>




                          ';


			


            
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

		$filter_sql=" j.isDeleted=0  and j.isValidated=0";
		$whereAll=" " ;
		

	if(!empty($_GET['jv_no']))
	{
		$emp=" jv_no=:jv_no ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'jv_no','val'=>$_GET['jv_no'],'type'=>0);
		$filter_sql.=$emp;
	}
	if(!empty($_GET['clnt_id']))
	{
		$emp=" clnt_id=:clnt_id ";    
		if(!empty($filter_sql))
		{
			$filter_sql.=" AND ";
		}
		$bindings[]=array('key'=>'clnt_id','val'=>$_GET['clnt_id'],'type'=>0);
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
$complete_query="SELECT CONCAT(cl.fname ,' ', cl.lname ) fullname ,j.jv_id, j.jv_no ,j.clnt_id
FROM `journal_voucher` j
INNER JOIN client_list cl ON j.clnt_id =cl.client_number 

{$where} {$order} {$limit}";    

//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();

$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();



$recordsTotal=$con->myQuery("SELECT COUNT(j.jv_id)
FROM journal_voucher j  {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsTotal;
$json['recordsFiltered']=$recordsTotal;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);
	die;







                     ?>
              






