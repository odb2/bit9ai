<?php
    // todo
    // $servername = "localhost";
	// $username = "root";
	// $password = "";
	// $db="movie";
	// $conn = mysqli_connect($servername, $username, $password,$db);

    // Fetching Values From URL
    if ($_POST['method'] === "search") {
        $search1 = $_POST['search'];
        $key = "2d3933b370ff193110922c3b68cd842b";

        $json = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=$key&query=$search1&page=1");
        
        // todo
        // $ip = $_SERVER['REMOTE_ADDR'];
        // $sql = "INSERT INTO `crud`( `searchTerm`, `dateTime`, `ipAddress`) 
        // VALUES ('$search1','NOW()','$ip')";
        // if (mysqli_query($conn, $sql)) {
        //     echo json_encode(array("statusCode"=>200));
        // } 
        // else {
        //     echo json_encode(array("statusCode"=>201));
        // }
        // mysqli_close($conn);

        echo $json;
    } else if ($_POST['method'] === "details") {
        $search1 = $_POST['search'];
        $search1 = str_replace(' ', '+', $search1);
        $key = "2d3933b370ff193110922c3b68cd842b";

        $json = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=$key&query=$search1&page=1");

                
        // todo
        // $ip = $_SERVER['REMOTE_ADDR'];
        // $sql = "INSERT INTO `crud`( `searchTerm`, `dateTime`, `ipAddress`) 
        // VALUES ('$search1','NOW()','$ip')";
        // if (mysqli_query($conn, $sql)) {
        //     echo json_encode(array("statusCode"=>200));
        // } 
        // else {
        //     echo json_encode(array("statusCode"=>201));
        // }
        // mysqli_close($conn);
        
        echo $json;
    }
?>