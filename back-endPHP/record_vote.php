<?php
include("connect_db.php");

function recordVote($conn, $jokeId, $vote) {
    $sql_check = "SELECT * FROM user_votes WHERE joke_id = $jokeId AND ip_address = '{$_SERVER['REMOTE_ADDR']}'";
    $result_check = $conn->query($sql_check);
    if ($result_check->num_rows > 0) {
        $sql_update = "UPDATE user_votes SET vote = '$vote' WHERE joke_id = $jokeId AND ip_address = '{$_SERVER['REMOTE_ADDR']}'";
        $conn->query($sql_update);
    } else {
        $sql_insert = "INSERT INTO user_votes (joke_id, vote, ip_address) VALUES ($jokeId, '$vote', '{$_SERVER['REMOTE_ADDR']}')";
        $conn->query($sql_insert);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jokeId = $_POST["jokeId"];
    $vote = $_POST["vote"];

    recordVote($conn, $jokeId, $vote);
    
    //Set cookie trong 1 ngày
    setcookie("voted_for_$jokeId", $jokeId, time() + (86400 * 1), "/");
}
?>
