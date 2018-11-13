<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Отправка вопросов на сервер</title>
    <style>
     body{
            font-family: Arial, Helvetica, sans-serif;
        }
        section{
            margin:auto;
            max-width: 80%;
            text-align: left;
        }
        div{
            text-align: center; 
            max-width: 90%; 
            border:0px solid #cccc;
            margin:auto;
            padding: 20px;
            border-radius: 5px;
            background-color: #FFCE00;
            box-shadow:0 0 15px black;
        }
        a{
            border-radius: 2px;
            background-color: #007EFF;
            color:black;
            text-decoration: none;
            padding: 5px 14px;
            margin-top:10px;
            
        }
        a:hover
        {box-shadow:0 0 10px #007EFF;}
    </style>
</head>

<body>
<section>
<?php 
echo "<pre>";
echo "</pre>";
echo "Вы вошли под ".$_COOKIE['user_name'];
if (!$_COOKIE['user_name']){
header('HTTP/1.0 403 Unauthorized');
}
else{
    $file = file_get_contents("users.json",  "r");
    $file = json_decode($file, true);
    if ($_COOKIE['user_auth']=='YES'){
        if ($file[$_SERVER['PHP_AUTH_USER']] and $_SERVER['PHP_AUTH_PW']===$file[$_SERVER['PHP_AUTH_USER']]){ 
    ?>
        <form action="" name="form1" method="post" enctype="multipart/form-data">
        <p>Выберите JSON файл для загрузки на сервер</p>
        <p><input type="file" name="questions" /></p>
        <p>Выберите картинку</p>
        <p><input type="file" name="avatar" /></p>
        <p><input type="submit" name="OK" value="OK" /></p>
        </form>
        <?php
        }
    }
if (isset($_POST['OK']) and !empty($_FILES)){
    ?><div><?php
    if (move_uploaded_file($_FILES['questions']['tmp_name'], __DIR__."/uploads/".$_FILES['questions']['name'])) {
        echo "Файл корректен и был успешно загружен.\n";
        header("Location: list.php");
        exit;
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
    echo "<br><p style='font-style:italic;'>ФАЙЛ: ".$_FILES['questions']['name'].":</p><br>";
    $file = file_get_contents(__DIR__."/uploads/".$_FILES['questions']['name'], "r");
    
if (move_uploaded_file($_FILES['questions']['tmp_name'], '1.jpg')) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}
echo "<p><a href='admin.php'>Загрузить еще вопросы</a></p>";

}
echo "<p><a href='list.php'>К списку вопросов</a></p>";
}
?>
</section>
</body>
</html>