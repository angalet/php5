
</<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Сраница входа</title>
</head>
<body>
    <form method="post">
        <p>Авторизоваться <input type="submit" name="auth" value="OK" /></p>
        
        <p>Ввести имя для использования без авторизации <input type="text" name="name_nonauth"  /></p>
        <p>Продолжить без авторизации <input type="submit" name="nonauth" value="OK" /></p>
    </form>
</body>
</html>
<?php
session_start();
$file = file_get_contents("users.json",  "r");
$file = json_decode($file, true);
if (isset($_POST["auth"])){
if (!isset($_SESSION['NAME']) and isset($_SERVER['PHP_AUTH_USER'])) {
    
    if ($file[$_SERVER['PHP_AUTH_USER']] and $_SERVER['PHP_AUTH_PW']===$file[$_SERVER['PHP_AUTH_USER']]){
        $_SESSION['NAME'] = $_SERVER['PHP_AUTH_USER'];
        setcookie("user_name", $_SERVER['PHP_AUTH_USER']);
        setcookie("user_auth", "YES");
        echo "вы авторизовались".$_SESSION['NAME'];
        header("Location: admin.php");
    }
} 
if  ($_COOKIE['user_auth']=='YES') {
    if ($file[$_SERVER['PHP_AUTH_USER']] and $_SERVER['PHP_AUTH_PW']===$file[$_SERVER['PHP_AUTH_USER']]){
        header("Location: admin.php");
    }
}
if (!isset($_SESSION['NAME'])) {
    header('WWW-Authenticate: Basic realm="admin"');
    header('HTTP/1.0 401 Unauthorized');
    echo "вы не авторизовались";
    exit;
}
}
if (isset($_POST["nonauth"]) and $_POST["name_nonauth"]){
    setcookie("user_name", $_POST["name_nonauth"]);
    setcookie("user_auth", "NO");
    header("Location: admin.php");
}
?>
