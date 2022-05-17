<?php
require_once("db_connect.php");

if($db_connect) {
    //$sql = "INSERT INTO `demo-movies` (`ID`, `title`, `director`, `year`) VALUES (NULL, ?, ?, ?)";
    $sql = "INSERT INTO `todo` (`task`) VALUES (?)";
    $insertedRows= 0;

    if($statement= $db_connect->prepare($sql)){
        $statement->bind_param('s', $_REQUEST['task']);
        $statement->execute();
        $insertedRows += $statement->affected_rows;

        if($insertedRows>0){
           $resultArray[] = [
                "insertedRows"=>$insertedRows,
              ];
                
        } else {
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