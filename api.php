<?php
include ('dbconnection.php');
$myArray = array(); // holder for data to be returned via the api
$myRow = array(); 

if(empty($_POST['iload'])){
   $vlimit = 1;
}else{
   $vlimit = $_POST['iload'];
}
if(isset($_POST['oset'])){
    $oset = $_POST['oset'];
}else{
    $oset = 0;
}

$myArray['vlimit'] = $vlimit;
$myArray['oset'] = $oset;

$query = "SELECT * FROM `bposts` ORDER BY id ASC LIMIT ".$vlimit." OFFSET " . $oset ;
$myArray['query'] = $query ;
$result = $link->query($query);

while($row = $result->fetch_array()){
    $myRow[] = array(
        "id" => $row['id'],
        "content" => $row['content'],
        "date" => $row['date']
    );
}

$myArray['content'] = $myRow;
echo json_encode($myArray);


