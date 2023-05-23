<?php
// 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "mydatabase";

// 데이터베이스 연결
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 연결 확인
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// POST 방식으로 사용자 입력 데이터 받기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 데이터 검증 및 보안 처리
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);

    $newLocation = 'ririko01.html';

    // 중복 아이디 검사 쿼리
    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        // 이미 존재하는 아이디인 경우
        echo "既に存在するIDです";
    } else {
        // 회원가입 데이터 삽입 쿼리
        $insert_query = "INSERT INTO users (username, password, email, phone) VALUES ('$username', '$password', '$email', '$phone')";
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            // 회원가입이 성공한 경우
            echo "회원가입이 완료되었습니다. 감사합니다!";
            // 초기 페이지로 이동
            $newLocation = 'http://localhost:8888/ririko01.html';
            header('Location: ' . $newLocation);
        } else {
            // 회원가입이 실패한 경우
            echo "회원가입 중 오류가 발생했습니다. 다시 시도해주세요.";
        }        
    }
}

// 데이터베이스 연결 종료
mysqli_close($conn);
?>
