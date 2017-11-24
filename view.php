<?php
   $unique_key = $_GET['s'];
   include('setup.php');
   $sql = "SELECT paste_data FROM pastebin WHERE unique_key='" . $unique_key . "';";
   $result = $conn->query($sql);
   if($result->num_rows > 0){
       while($row = $result->fetch_assoc()){
           $paste_data = $row["paste_data"];
       }
   }
   if(!$paste_data){
       echo "Error 404 <hr> Page not found";
   }
   else{
       echo $paste_data;
   }
?>
