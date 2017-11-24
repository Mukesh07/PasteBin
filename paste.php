<?php
    include('setup.php');
    $unique_key = generateKey();
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $paste_data = $_POST["paste_data"];
        $sql = "INSERT INTO pastebin (paste_data, unique_key) values ('" . $paste_data . "','" . $unique_key . "');";
        if($conn->query($sql) == TRUE) {
            $paste_link = "http://localhost/pastebin/view.php?s=" . $unique_key;
            echo "The paste link is <a href=" . $paste_link . ">" . $paste_link . "</a>";
        }
        else{
            echo "Error: " .$sql . "<br>";
        }
    }
    function generateRandomString(){
            $length = 7;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for($i = 0; $i < $length; $i++){
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        function generateKey(){
          include('setup.php');
            $rand = generateRandomString();
            $sql = "SELECT * from pastebin where unique_key='" . $rand . "';";
            $index_result = $conn->query($sql);
            if($index_result->num_rows === 0){
                return $rand;
            }
            else{
                generateKey();
            }
            $conn->close();
        }
?>
