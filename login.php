<?php
// 이 부분에서 데이터베이스 연결 및 사용자 인증 로직을 구현해야 합니다.

include('./db_conn.php');


$userid = $_POST["userid"];
$password = $_POST["password"];
// SQL 쿼리를 사용하여 사용자 인증
$query = "SELECT * FROM member WHERE id='$userid' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
  echo "로그인 성공.";
    header('Location: ./main.php'); // 로그인 성공 시 리다이렉션할 페이지로 이동
} else {
    // 로그인 실패
    echo "로그인 실패. 다시 시도하세요.";
}

// 데이터베이스 연결 종료
$conn->close();

?>
