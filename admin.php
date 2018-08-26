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
            max-width: 50%;
            text-align: left;
        }
        div{
            text-align: left; 
            max-width: 40%; 
            border:1px solid #cccc;
            margin:auto;
            padding: 20px;
            border-radius: 5px;
            background-color: #cccc;
            box-shadow:0 0 15px black;
        }
    </style>
</head>

<body>
<section>
<?php if ($_REQUEST['OK'] != "OK"){ ?>
<form action="" name="form1" method="post" enctype="multipart/form-data">
<p>Выберите JSON файл для загрузки на сервер</p>
<p><input type="file" name="questions" /></p>
<p>Выберите картинку</p>
<p><input type="file" name="avatar" /></p>
<p>Введите название опроса</p>
<p><input type="text" name="test_name" /></p>
<p><input type="submit" name="OK" value="OK" /></p>
</form>
<?php
}
if (isset($_POST['OK']) and !empty($_FILES)){
    //echo $_POST['questions'];
    echo '<pre>';
    print_r($_FILES);
    file_put_contents('test.txt', 'zxczczxczc');
    if (move_uploaded_file($_FILES['questions']['tmp_name'], 'new_json.txt')) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
    echo __DIR__."/json.txt";
    echo "<br><p style='font-style:italic;'>ФАЙЛ: ".$_FILES['questions']['name'].":</p><br>";
    $file = file_get_contents('new_json.txt', "r");
    $file1 = file_get_contents(__DIR__."/json.txt", "r");
    //print_r($_FILES);
//$file = $_FILES['questions']['name'];
//echo '<img src='.$_FILES['avatar']['tmp_name'].' />';
if (move_uploaded_file($_FILES['avatar']['tmp_name'], '1.jpg')) {
    echo "Файл корректен и был успешно загружен.\n";
    echo '<img src="1.jpg" />';
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

var_dump(json_decode($file, true));
echo '</pre>';
//var_dump($file1);
//$file = array();
//$file = file('$file');
//var_dump($file);
echo $_POST['test_name'];
}

?>
</section>
</body>
</html>