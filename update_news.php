<?php
// تمكين عرض الأخطاء
ini_set('display_errors', 1);
error_reporting(E_ALL);

// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'news_sestem');

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من أن البيانات تم إرسالها عبر POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استلام البيانات من الفورم
    $news_id = intval($_POST['news_id']);  // تحويل المعرف إلى عدد صحيح
    $title = $conn->real_escape_string($_POST['title']);  // تأمين البيانات
    $category = $conn->real_escape_string($_POST['category']);
    $details = $conn->real_escape_string($_POST['details']);

    // التحقق إذا كانت الحقول غير فارغة
    if (empty($title) || empty($category) || empty($details)) {
        echo "جميع الحقول يجب أن تكون مملوءة!";
        exit();
    }

    // استعلام لتحديث الخبر في قاعدة البيانات
    $sql = "UPDATE news SET title = '$title', category = '$category', details = '$details' WHERE id = $news_id";

    // تنفيذ الاستعلام
    if ($conn->query($sql) === TRUE) {
        // إعادة التوجيه بعد التحديث الناجح
        header("Location: view_news.php");
        exit();  // توقف الكود بعد التوجيه
    } else {
        echo "حدث خطأ أثناء التحديث: " . $conn->error;
    }
}

// إغلاق الاتصال بعد الانتهاء
$conn->close();
?>
<form method="POST" action="update_news.php">
    <input type="hidden" name="news_id" value="<?php echo $row['id']; ?>" />
    <!-- باقي الحقول هنا -->
</form>
<?php
// طباعة البيانات المرسلة عبر POST للتحقق
echo '<pre>';
var_dump($_POST);
echo '</pre>';