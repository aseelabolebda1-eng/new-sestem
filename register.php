<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'news_sestem');

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من إرسال بيانات التسجيل
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور

    // التحقق إذا كان البريد الإلكتروني موجودًا في قاعدة البيانات
    $sql_check = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql_check);
    if ($result->num_rows > 0) {
        echo "البريد الإلكتروني موجود بالفعل.";
    } else {
        // استعلام لإضافة المستخدم إلى قاعدة البيانات
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "تم إنشاء الحساب بنجاح!";
            header("Location: login.php"); // إعادة التوجيه إلى صفحة تسجيل الدخول
        } else {
            echo "حدث خطأ أثناء إنشاء الحساب: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل حساب جديد</title>
</head>
<body>

<h2>تسجيل حساب جديد</h2>

<form method="POST">
    <label for="username">الاسم:</label>
    <input type="text" name="username" required /><br>

    <label for="email">البريد الإلكتروني:</label>
    <input type="email" name="email" required /><br>

    <label for="password">كلمة المرور:</label>
    <input type="password" name="password" required /><br>

    <button type="submit">إنشاء الحساب</button>
</form>

</body>
</html>