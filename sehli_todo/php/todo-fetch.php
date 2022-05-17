<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("db_connect.php");

if($db_connect) {

     $sql = "SELECT `todo`.ID, `todo`.task, `todo`.completed
      FROM `todo`";
    $resultArray=[];

    if($statement = $db_connect->prepare($sql)){
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
        $statement->close();
    }else{
        $resultArray[] = [
            "error"=>"error",
         ];
        echo json_encode($resultArray);
    }
}
 mysqli_close($db_connect); 
?>

