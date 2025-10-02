<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'news_sestem');

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من إرسال بيانات تسجيل الدخول
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    // استعلام للبحث عن المستخدم في قاعدة البيانات
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // التحقق من كلمة المرور
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo "تم تسجيل الدخول بنجاح!";
            header("Location: dashboard.php"); // إعادة التوجيه إلى لوحة التحكم
        } else {
            echo "كلمة المرور غير صحيحة.";
        }
    } else {
        echo "البريد الإلكتروني غير موجود.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
</head>
<body>

<h2>تسجيل الدخول</h2>

<form method="POST">
    <label for="email">البريد الإلكتروني:</label>
    <input type="email" name="email" required /><br>

    <label for="password">كلمة المرور:</label>
    <input type="password" name="password" required /><br>

    <button type="submit">تسجيل الدخول</button>
</form>

</body>
</html>