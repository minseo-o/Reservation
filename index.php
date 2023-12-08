<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP Board with Image Upload</title>
</head>

<body>

    <?php
   include('./db_conn.php');

    // 게시물 불러오기
    $sql = "SELECT id, title, content, image_path, created_at FROM posts ORDER BY created_at DESC";
    $result = $conn->query($sql);

    // 게시물 목록 출력
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h2>" . $row["title"] . "</h2>";
            echo "<p>" . $row["content"] . "</p>";
            
            // 이미지 출력
            if (!empty($row["image_path"])) {
                echo '<img src="' . $row["image_path"] . '" alt="Post Image" style="max-width: 100%;">';
            }
            
            echo "<p>Created at: " . $row["created_at"] . "</p>";
            echo "</div>";
        }
    } else {
        echo "No posts yet.";
    }

    // 이미지 출력
if (!empty($row["image_path"]) && file_exists($row["image_path"])) {
    echo '<img src="' . $row["image_path"] . '" alt="Post Image" style="max-width: 100%;">';
} else {
    echo 'No image available.';
}

    // 데이터베이스 연결 종료
    $conn->close();
    ?>

    <!-- 게시물 작성 폼 -->
    <form action="submit_post.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" required></textarea>
        <br>
        <label for="image">Image:</label>
        <input type="file" name="image">
        <br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>
