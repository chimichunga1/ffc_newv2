<?php

require_once("../../support/config.php");
// if(!isLoggedIn())
// {
//     toLogin();
//     die();
// }
// if(!AllowUser(array(1,2,3)))
// {
//     redirect("index.php");
// }


$primaryKey ='user_id';
$index=-1;

$columns = array(
array( 'db' => 'user_id','dt' => ++$index,'formatter'=>function($d,$row)
{
	return htmlspecialchars($d);
} ),
array( 'db' => 'emp_name','dt' => ++$index,'formatter'=>function($d,$row)
{
	return htmlspecialchars($d);
} ),
array( 'db' => 'username','dt' => ++$index,'formatter'=>function($d,$row)
{
   return htmlspecialchars($d);
} ),
array( 'db' => 'user_type','dt' => ++$index,'formatter'=>function($d,$row)
{
   return htmlspecialchars($d);
} ),

array(
        'db'        => 'user_id',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        {
            $action_buttons="";
                
                //     if($row['approval_status']=="Approved-Undone"):
                //     $action_buttons.="<a class='btn btn-sm btn-success btn-flat' title='Proceeds' href='frm_loan_application.php?tab=2&id={$row['loaner_id']}&u={$row['loan_code']}'><span class='fa fa-arrow-right'></span></a>&nbsp;";
                // else:
                //     $action_buttons.="<a class=' btn btn-sm btn-success btn-flat' title='View Details' href='forApprovalDetails.php?id={$d}'><span class='fa fa-eye'></span></a>&nbsp";
                //     $action_buttons.="<button class='btn btn-sm btn-danger btn-flat'  title='Reject Loan Application' onclick='reject(\"{$row['loan_code']}\")'><span  class='fa fa-close'></span></button>&nbsp;";
                // endif; 
                    if ($row['user_type_id'] == 1) {
                        $disabled = 'disabled';
                    } else {
                        $disabled = '';
                    }
                    if($row['is_active'] ==1){
                        $action_buttons.="<a class='btn btn-flat btn-sm btn-success' href='activate.php?id={$row['user_id']}' onclick='return confirm(\"Are you sure you want to deactivate this user?\")'  ".$disabled."><span class='fa fa-lock'></span> Deactivate</a>&nbsp;";
                    }else{
                        $action_buttons.="<a class='btn btn-flat btn-sm btn-danger' href='activate.php?id={$row['user_id']}' onclick='return confirm(\"Are you sure you want to activate this user?\")'><span class='fa fa-unlock' ></span> Activate</a>&nbsp;";
                    }
                    $action_buttons.="<a class='btn btn-sm btn-success btn-flat' title='Update User' href='frm_user.php?user_id=" .$d. "'>  <span class='fa fa-edit'></span></a>&nbsp;";
                     $action_buttons.="<a class='btn btn-sm btn-danger btn-flat' onclick='return confirm(\"Are you sure to delete this user?\")' title='Delete User' href='delete.php?id={$row['user_id'] }&t=users'> <span class='fa fa-trash'></span></a>&nbsp;";
                    
      
            return $action_buttons;
        }
    ),
array(
        'db'        => 'is_active',
        'dt'        => ++$index,
        'formatter' => function( $d, $row ) 
        { 
            return "";
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


// if(!empty($_GET['company']))
// {
//     $company_sql=":company";
//     $inputs['company']=$_GET['company'];
//     $filter_sql.=" AND company_id = ".$company_sql."";
//     $bindings[]=array('key'=>'company','val'=>$_GET['company'],'type'=>0);
//     //$company_sql = !empty($_GET['company']);
// }

$whereAll=" users.is_deleted=0"; //dagdag ung nakasession na user :)
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
$complete_query="SELECT user_id, username , CONCAT(last_name,', ',first_name,' ', middle_initial) as `emp_name`,is_active,user_type, users.user_type_id
             FROM `users` INNER JOIN user_types on users.user_type_id = user_types.user_type_id  {$where} {$order} {$limit}";    
//NEED TO CREATE VIEWS.

$data=$con->myQuery($complete_query,$bindings)->fetchAll();
$recordsFiltered=$con->myQuery("SELECT FOUND_ROWS();")->fetchColumn();

$recordsTotal=$con->myQuery("SELECT COUNT(user_id) FROM `users` INNER JOIN user_types on users.user_type_id = user_types.user_type_id {$where};",$bindings)->fetchColumn();


$json['draw']=isset ( $request['draw'] ) ?intval( $request['draw'] ) :0;
$json['recordsTotal']=$recordsFiltered;
$json['recordsFiltered']=$recordsFiltered;
$json['data']=SSP::data_output($columns,$data);

echo json_encode($json);

// $resTotalLength = SSP::sql_exec( $db, $bindings,
//             "SELECT COUNT(`{$primaryKey}`)
//              FROM   `$table` ".
//             $whereAllSql
//         );

die;
