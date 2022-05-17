<?php
require_once("db_connect.php");


if(mysqli_connect_errno()){
die('Connect Error(' . mysqli_connect_errno(). ') '. mysqli_connect_error());

}

if($db_connect) {
    $sql = "DELETE FROM `demo-movies` WHERE `demo-movies`.`ID` = ?";

    $insertedRows= 0;

    if($statement= $db_connect->prepare($sql)){
        $statement->bind_param('i', $_REQUEST['ID']);
        $statement->execute();
        $deletedRows += $statement->affected_rows;

        if($deletedRows>0){
            $resultArray[] = [
                "deletedRows"=>$deletedRows,
            ];

        } else {
            $resultArray[] = [
                "deletedRows"=>$deletedRows,
            ];
    }
    $statement->close();
    } else {
        $resultArray[] =[
            "error"=>"statement didn't run",
        ];
    }
  echo json_encode($resultArray);
   
}
$db_connect->close();
?>

