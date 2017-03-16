<?php

require_once 'dbConfig.php';

// The types of request that we need to handle from the client side will include, a SELECT basic query in which we will
//run a simple select query. It can include filters in the search bar, where the value can be retrieved from the POST array
//using $_POST['search']['value'], we can then run LIKE query which matches the records against the search value. Lastly we
// have to run the query to sort according to the columns clicked upon from the client side.

$columns = array(
    // datatable column index  => database column name
    0 => 'Fname',
    1 => 'Lname',
    2 => 'Email',
    3 => 'Phone'
);

//Writing the basic search query without any search and sort
$sql = "SELECT ID,Fname,Lname,Email,Phone FROM Users";
$query = mysqli_query ($con, $sql);
$totalData = mysqli_num_rows ($query);
$filteredData = $totalData;//Initially as filters are absent, we assign the equal values to the
//filtered data and total data


//now we write a sql query in case we have filters
$sql = "SELECT ID,Fname,Lname,Email,Phone FROM Users WHERE 1=1";
if (!empty($_POST['search']['value'])) {
    $sql .= "AND ( Fname LIKE '" . $_POST['search']['value'] . "%' OR Lname LIKE '" . $_POST['search']['value'] . "%'";
    $sql .= "OR Email LIKE '" . $_POST['search']['value'] . "%' OR Phone LIKE '" . $_POST['search']['value'] . "%'";
}
//Applying orders that are applied to the datatable from the client side
$query = mysqli_query ($con, $sql) or die("Query Couldn't be Processed");
$filteredData = mysqli_num_rows ($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

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
$sql .= "  LIMIT " . $_POST['start'] . " ," . $_POST['length'] . "  ";
$query = mysqli_query ($con, $sql) or die("Query couldn't be processed");
$data = array();
//$html="<h1>HEY</h1>";
while ($row = mysqli_fetch_array ($query)) {  // preparing an array
    $nestedData = array();
    $nestedData[]=$row["ID"];
    $nestedData[] = $row["Fname"];
    $nestedData[] = $row["Lname"];
    $nestedData[] = $row["Email"];
    $nestedData[] = $row["Phone"];
  //  $nestedData[] = $html;



    $data[] = $nestedData;
}


$json_data = array(
    "columns"=>array(0=>"First Name",1=>"Last Name",2=>"Email",3=>"Phone"),
    "draw" => intval ($requestData['draw']),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal" => intval ($totalData),  // total number of records
    "recordsFiltered" => intval ($filteredData), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data" => $data   // total data array
);

echo json_encode ($json_data);  // send data as json format

?>