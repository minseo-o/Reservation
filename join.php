<?php
// 데이터베이스 연결 정보
include('./db_conn.php');

try {
    
    $name = $_POST["uname"];
    $id = $_POST["uid"];
    $password = $_POST["upassword"];
    $mail = $_POST["uemail"];
    $mobile = $_POST["umobile"];
    $gender = $_POST["gender"];

    // 사용자 정보를 데이터베이스에 삽입하는 SQL 쿼리
    $sql = "INSERT INTO member  VALUES ( '$id', '$password','$name', '$mail','$mobile' ,'$gender')";

    // SQL 쿼리 실행
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! Welcome, " . $name . "!";
        header('Location: main.html'); // 로그인 성공 시 리다이렉션할 페이지로 이동
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // 데이터베이스 연결 종료
    $conn->close();

} catch (Exception $e) {
    // 데이터베이스 연결이 실패하면 에러 메시지 출력
    echo "Error: " . $e->getMessage();
}
?>



