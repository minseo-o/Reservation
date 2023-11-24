<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 데이터베이스 연결 설정 (위와 동일)
    include('./db_conn.php');
    // 게시물 제출 처리
    $title = $_POST["title"];
    $content = $_POST["content"];
    $imagePath = null;

    // 이미지 업로드 처리
    if (!empty($_FILES["image"]["name"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // 파일 유형 검사
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // 이미지 업로드
        if ($uploadOk) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                $imagePath = $targetFile;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // 데이터베이스에 게시물 정보 저장
    $sql = "INSERT INTO posts (title, content, image_path) VALUES ('$title', '$content', '$imagePath')";

    if ($conn->query($sql) === TRUE) {
        echo "Post submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // 데이터베이스 연결 종료
    $conn->close();
}
?>
