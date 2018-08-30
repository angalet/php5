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
<div>
<?php
if($_GET['quest']){
//print_r($_GET);
//echo '/uploads/'.$_GET['quest'];

$file = file_get_contents(__DIR__.'/uploads/'.$_GET['quest'], "r");
$file = json_decode($file, true);
$n = 1;
$m = 0;
echo "<form method='get' action='test.php'>";
echo '<img src="1.jpg" width="400"><br>';
echo "<p><h1>".$file[0]['test_name']."</h1></p>";
foreach($file as $value)
{
$i =1;

echo "<p style='background-color:#FFCE00;border-radius:5px;text-align: left;'>Вопрос № $n - ".$value['questin']."<br>";
while($i<=$value['num_quest']){
echo "<input type='radio' name=".$m." value=".$i." />".$value[$i]."<br>";
$i++;
}
$n++;
$m++;
echo "</p>";
}
echo "<input type='text' name='file' value=".$_GET['quest']." hidden />";
echo '<p><input class="OK" type="submit" name="OK" value="OK" /></p>';
echo "</form>";
echo "<a href='http://localhost/php5/list.php'>К списку вопросов</a>";
?></div><?php
}
if (isset($_GET['OK'])){
   print_r($_GET);
   
}
?>


</section>
</body>
</html>