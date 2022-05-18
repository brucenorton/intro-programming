<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db_connect.php");
    $resultArray=[];
if($db_connect) {
$taskID = $_REQUEST['ID'];
     $sql = "SELECT `todo`.ID, `todo`.task, `todo`.completed
      FROM `todo` 
      WHERE `todo`.ID = ?";


    if($statement = $db_connect->prepare($sql)){
        $statement->bind_param('i', $taskID);
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
        //echo json_encode($resultArray);
        markCompleted($resultArray[0]["completed"]);
        $statement->close();
    }else{
        $resultArray[] = [
            "error"=>"error",
         ];
        //echo json_encode($resultArray);
    }
}

function markCompleted($setCompleted){
  $taskID = $_REQUEST['ID'];
    if($setCompleted == 0){
      $setCompleted = 1;
    }else{
      $setCompleted = 0;
    }
    require("db_connect.php");
    if($db_connect) {
        $sql = "UPDATE `todo` SET `completed` = $setCompleted WHERE `todo`.`ID` = (?)";
          $insertedRows= 0;
      
          if($statement= $db_connect->prepare($sql)){

              $statement->bind_param('i', $taskID);
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
                    "taskID"=>$taskID,
                  ];
      
              }
          }
      
          $statement->close();
        echo json_encode($resultArray);
      }
}

?>

