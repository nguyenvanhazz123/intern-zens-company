<?php
// Kết nối đến cơ sở dữ liệu
include("connect_db.php");


//Lấy tổng bài
function getTotalJokes($conn) {
    $sql = "SELECT COUNT(*) AS total_jokes FROM jokes";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_jokes'];
    } else {
        return 0;
    }
}

//Random bài ngẫu nhiên không trùng lặp
function getRandomJoke($conn) {
    $skipped_posts = [];

    if(isset($_COOKIE)){
        foreach ($_COOKIE as $cookie_name => $cookie_value) {
            if (strpos($cookie_name, 'voted_for_') === 0) {
                $post_id = substr($cookie_name, strlen('voted_for_'));
                $skipped_posts[] = $post_id;
            }
        }
    }

    $current_joke_id = isset($_COOKIE['current_joke_id']) ? $_COOKIE['current_joke_id'] : 0;
    $totalJokes = getTotalJokes($conn);

    if (!empty($skipped_posts)) {
        if ($current_joke_id !== null && count($skipped_posts) < $totalJokes - 1) {
            $skipped_posts[] = $current_joke_id;
        }
        $skipped_posts_str = implode(",", $skipped_posts);
        $sql = "SELECT * FROM jokes WHERE id NOT IN ($skipped_posts_str) ORDER BY RAND() LIMIT 1";
    } else {
        $sql = "SELECT * FROM jokes WHERE id != $current_joke_id  ORDER BY RAND() LIMIT 1";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        //Thêm cookie cho bài viết cũ để so sánh sự không trùng lặp
        setcookie("current_joke_id", $row['id'], time() + (86400 * 1), "/");
        
        return $row;
    } else {
        return false;
    }
}

$joke = getRandomJoke($conn);

if ($joke) {
    // Hiện nội dung
    echo "<div class='description'>";
    echo "<p>{$joke['joke_text']}</p>";
    echo "</div>";

    // Kiểm tra xem người dùng đã vote cho câu chuyện này chưa
    $jokeId = $joke['id'];
    if (isset($_COOKIE["voted_for_$jokeId"])) {
        echo "<p class='not-joker'>You've already voted for this joke.</p>";
    } else {
        // Hiển thị các button
        echo "<div class='action'>";
        echo "<div class='action-button'>";
        echo "<button onclick=\"recordVote($jokeId, 'like')\">This is Funny!</button>";
        echo "<button onclick=\"recordVote($jokeId, 'dislike')\">This is not Funny.</button>";              
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<p class='not-joker'>That's all the jokes for today! Come back another day!</p>";
}

// Đóng kết nối
$conn->close();
?>
