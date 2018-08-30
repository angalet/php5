<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Выбрать тест</title>
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
            display: inline-block;
            border-radius: 2px;
            color:black;
            text-decoration: none;
            padding: 5px 10px;
            margin-top:10px;
            border:1px solid blue;
            min-width: 70%;
            max-width: 70%;
            
        }
        a:hover
        {box-shadow:0 0 10px #007EFF;}
    </style>
</head>

<body>
<section>
<?php
if ($handledir = opendir(__DIR__."/uploads/")) {
    while (false !== ($file = readdir($handledir))) { 
        //echo "|".$file."|<br>";
        $name = $file;
$file = file_get_contents(__DIR__."/uploads/".$file,  "r");
echo $_POST['test_name'];
$file = json_decode($file, true);
if ($file){
echo "<p><h1><a href='test.php?quest=".$name."'>Пройти тест - ".$file[0]['test_name']."</a></h1></p>";
}
    }
    echo "<a href='http://localhost/php5/admin.php'>Загрузить вопросы</a>";
}
?>
</section>
</body>
</html>