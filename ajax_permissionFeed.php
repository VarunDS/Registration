<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30/03/17
 * Time: 12:40 PM
 */

require_once 'dbConfig.php';
$role_id = $_POST['role_id'];
$sql = "SELECT p.perm_id,p.perm_desc FROM permissions p " .
       "INNER JOIN role_perm rp ON rp.perm_id=p.perm_id" .
       " WHERE rp.role_id='" . $role_id . "'";

$result = mysqli_query ($con, $sql) or die ("Query cannot be processed");

$result_array = array();
while ($row = mysqli_fetch_assoc ($result)) {
    $result_array[] = $row;
}


$sql_all = "SELECT perm_id,perm_desc FROM permissions WHERE 1=1";
$result_all = mysqli_query ($con, $sql_all) or die ("Query cannot be processed");

$result_array_all = array();
while ($row_all = mysqli_fetch_assoc ($result_all)) {
    $result_array_all[] = $row_all;
}


echo json_encode (
    array(
        'granted_permission' => $result_array,
        'all_permission' => $result_array_all
    )
);