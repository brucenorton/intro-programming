<?php
require_once("db_connect.php");

if($db_connect) {
  $sql = "UPDATE `todo` SET `completed` = '1' WHERE `todo`.`ID` = (?)";

    $insertedRows= 0;

    if($statement= $db_connect->prepare($sql)){
        $statement->bind_param('i', $_REQUEST['ID']);
        $statement->execute();
        $insertedRows += $statement->affected_rows;

        if($insertedRows>0){
          // if succesful
            $resultArray[] = [
              "insertedRows"=>$insertedRows,
            ];

        } else {
            // if failed
            $resultArray[] = [
              "insertedRows"=>$insertedRows,
            ];

        }
    }

    $statement->close();
  echo json_encode($resultArray);
}

//Close connection
mysqli_close($db_connect);

?>