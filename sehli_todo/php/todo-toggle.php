<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db_connect.php");
$setCompleted = 1;
if($db_connect) {

     $sql = "SELECT `todo`.ID, `todo`.task, `todo`.completed
      FROM `todo` 
      WHERE `todo`.ID = ?";
    $resultArray=[];

    if($statement = $db_connect->prepare($sql)){
        $statement->bind_param('i', $_REQUEST['ID']);
        $statement->execute();
        $statement->store_result();
        $statement->bind_result($resID,$resTask,$resCompleted);

        while($statement->fetch()) {
             $resultArray[] = [
                "ID"=>$resID,
                "task"=>$resTask,
                "completed"=>$resCompleted,
             ];
        }
        echo json_encode($resultArray);
        markCompleted($resCompleted);
        $statement->close();
    }else{
        $resultArray[] = [
            "error"=>"error",
         ];
        echo json_encode($resultArray);
    }
}

function markCompleted($setCompleted){
    
    require("db_connect.php");
    if($db_connect) {
        $sql = "UPDATE `todo` SET `completed` = (?) WHERE `todo`.`ID` = (?)";
      
          $insertedRows= 0;
      
          if($statement= $db_connect->prepare($sql)){
              echo($_REQUEST['ID']);
              $statement->bind_param('i', $_REQUEST['ID']);

              $statement->execute();
              $insertedRows += $statement->affected_rows;
      
              if($insertedRows>0){
                // if succesful
                  $resultArray[] = [
                    "insertedRows"=>$insertedRows,
                    "setCompleted"=>$setCompleted,
                  ];
      
              } else {
                  // if failed
                  $resultArray[] = [
                    "insertedRows"=>$insertedRows,
                    "setCompleted"=>$setCompleted,
                  ];
      
              }
          }
      
          $statement->close();
        echo json_encode($resultArray);
      }
}

?>

