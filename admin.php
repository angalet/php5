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
    ?><div><?php
    //echo $_POST['questions'];
    echo '<pre>';
    //print_r($_FILES);
    file_put_contents('test.txt', 'zxczczxczc');
    if (move_uploaded_file($_FILES['questions']['tmp_name'], 'new_json.txt')) {
        echo "Файл корректен и был успешно загружен.\n";
    } else {
        echo "Возможная атака с помощью файловой загрузки!\n";
    }
    //echo __DIR__."/json.txt";
    echo "<br><p style='font-style:italic;'>ФАЙЛ: ".$_FILES['questions']['name'].":</p><br>";
    $file = file_get_contents('new_json.txt', "r");
    //print_r($_FILES);
//$file = $_FILES['questions']['name'];
//echo '<img src='.$_FILES['avatar']['tmp_name'].' />';
if (move_uploaded_file($_FILES['avatar']['tmp_name'], '1.jpg')) {
    echo "Файл корректен и был успешно загружен.\n";
    //echo '<img src="1.jpg" /><br>';
} else {
    echo "Возможная атака с помощью файловой загрузки!\n";
}

//var_dump(json_decode($file, true));

//var_dump($file1);
//$file = array();
//$file = file('$file');
//var_dump($file);
echo $_POST['test_name'];
$file = json_decode($file, true);
//$value - array();
//var_dump($file);
$n = 1;
echo "<form action='test.php'>";
echo '<img src="1.jpg" width="400"><br>';
echo "<p><h1>".$file[0]['test_name']."</h1></p>";
foreach($file as $value)
{
    //print_r($value);
    $i =1;
    
    echo "<p style='background-color:#FFCE00;border-radius:5px;text-align: left;'>Вопрос № $n - ".$value['questin']."<br>";
    while($i<=$value['num_quest']){
    //echo $i.") ".$value[$i]."<br>";
    echo "<input type='radio' name=".$value['questin']." value=".$i." />".$value[$i]."<br>";
    //$n = $value[$i];
    $i++;
    }
    $n++;
    echo "</p>";
}
echo '<p><input class="OK" type="submit" name="OK" value="OK" /></p>';
echo "</form>";

//print_r($value);
//echo '</pre>';
echo "<a href='http://localhost/php5/admin.php'>Назад</a>";
?></div><?php
}

?>

</section>
</body>
</html>