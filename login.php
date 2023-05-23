<?php
// 데이터베이스 연결 설정
$host = 'localhost'; // 호스트명
$db = 'users'; // 데이터베이스명
$user = 'root'; // 사용자명
$password = 'root'; // 비밀번호

// 데이터베이스 연결
$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 로그인 폼으로부터 전송된 데이터 수신
$username = $_POST['username'];
$password = $_POST['password'];

// 입력된 아이디와 비밀번호를 데이터베이스에서 검증
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($password === $row['password']) {
        // 로그인 성공 시 처리할 코드 작성
        session_start();
        $_SESSION['username'] = $row['username'];
        header("Location: next-page.html"); // 다음 페이지로 이동
        exit();
    } else {
        // 비밀번호 오류 처리
        echo "아이디 또는 비밀번호가 올바르지 않습니다.";
    }
} else {
    // 아이디 오류 처리
    echo "아이디 또는 비밀번호가 올바르지 않습니다.";
}

$conn->close();
?>
