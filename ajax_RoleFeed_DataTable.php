<?php

require_once 'dbConfig.php';

// The types of request that we need to handle from the client side will include, a SELECT basic query in which we will
//run a simple select query. It can include filters in the search bar, where the value can be retrieved from the POST array
//using $_POST['search']['value'], we can then run LIKE query which matches the records against the search value. Lastly we
// have to run the query to sort according to the columns clicked upon from the client side.


$booleanToInt = array(
    'true' => 1,
    'false' => 0
);
if ($_POST['operation'] == 'update') {
    $message = "Record Not Modified";
    $roles_array = array();

    parse_str ($_POST['detailsFormData'], $roles_array);
    //$roles_array=$_POST['formData'];
    $role_id = $roles_array['role_id'];
    $role_name = $roles_array['role_name'];
    $role_desc = $roles_array['role_desc'];

    foreach ($_POST['status_array'] as $key => $value) {
        $role_status = $value['state'];
    }
    $sql = "UPDATE roles SET role_name='" . $role_name . "', role_desc='" . $role_desc . "'" .
           ", role_status='" . $booleanToInt[$role_status] . "' WHERE role_id='" . $role_id . "'";
    $query = mysqli_query ($con, $sql) or die("Query Couldn't be Processed");
    if ($query) {
        $message = "Record Modified.";
    }
    foreach ($_POST['permissions_array'] as $key => $value) {
        $perm_id = explode ("_", $value['element']);
        $perm_id_value = $perm_id[2] . "_" . $perm_id[3];
        if ($value['state'] == "false") {
            $sql = "DELETE FROM role_perm WHERE role_id='" . $role_id . "' AND perm_id='" . $perm_id_value . "'";
        } else if ($value['state'] == "false") {
            $sql = "INSERT INTO role_perm(role_id, perm_id) VALUES ($role_id,$perm_id_value)";
        }
        $query = mysqli_query ($con, $sql) or die("Query Couldn't be Processed");
        if ($query) {
            $message = "Record Modified.";
        }
    }
    $json_data = array("message" => $message);
    echo json_encode ($json_data);

} else {
    $columns = array(
        // datatable column index  => database column name
        0 => 'role_id',
        1 => 'role_name',
        2 => 'role_status',
        3 => 'role_desc'
    );
//Writing the basic search query without any search and sort
    $sql = "SELECT role_id,role_name,role_status,role_desc FROM roles";
    $query = mysqli_query ($con, $sql);
    $totalData = mysqli_num_rows ($query);
    $filteredData = $totalData;//Initially as filters are absent, we assign the equal values to the
//filtered data and total data


//now we write a sql query in case we have filters and tags applied
    $sql = "SELECT role_id,role_name,role_status,role_desc FROM roles WHERE 1=1";


    if (!empty($_POST['search']['value'])) {
        $sql .= " AND ( role_name LIKE '" . $_POST['search']['value'] . "%')";
    }
//Applying orders that are applied to the datatable from the client side
    $query = mysqli_query ($con, $sql) or die("Query Couldn't be Processed");
    $filteredData = mysqli_num_rows ($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

    if (!empty($_POST['order'])) {
        $sql .= " ORDER BY ";

        $sqlOrderArray = array();
        $orderArray = array();
        $orderArray = $_POST['order'];

        foreach ($orderArray as $key => $value) {
            $sqlOrderArray[] = $columns[$value['column']] . " " . $value['dir'];
        }

        if (count ($sqlOrderArray) > 1) {
            $sql .= implode (',', $sqlOrderArray);
        } else {
            $sql .= $columns[$_POST['order'][0]['column']] . " " . $_POST['order'][0]['dir'];
        }
    }

    $sql .= "  LIMIT " . $_POST['start'] . " ," . $_POST['length'] . "  ";
    $query = mysqli_query ($con, $sql) or die("Query couldn't be processed");
    $data = array();

    while ($row = mysqli_fetch_array ($query)) {  // preparing an array

        $nestedData = array();
        $nestedData[] = $row["role_id"];
        $nestedData[] = $row["role_name"];
        $nestedData[] = $row["role_desc"];
        $nestedData[] = $row["role_status"];
        $nestedData[] = $row["role_id"];
        $data[] = $nestedData;
    }


    $json_data = array(

        "draw" => intval ($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
        "recordsTotal" => intval ($totalData),  // total number of records
        "recordsFiltered" => intval ($filteredData), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data" => $data   // total data array
    );

    echo json_encode ($json_data);  // send data as json format
}
