<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Пройти тест</title>
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
    if(isset($_GET['quest'])){
        if (!file_exists(__DIR__.'/uploads/'.$_GET['quest'])){
            header("HTTP/1.1 404 Not Found");
            echo "нет такого теста";
            exit();
        }else{
        $file = file_get_contents(__DIR__.'/uploads/'.$_GET['quest'], "r");
        
        $file = json_decode($file, true);
        $n = 1;
        $m = 0;
?>
    <form method='get' action='test.php'>
        <img src="1.jpg" width="400"><br>
        <p><h1>"<?php echo $file[0]['test_name']; ?>"</h1></p>
        <p><label for="name_user">Введите Ваше имя</label>
        <input name="name_user" required id="name_user" type="text"  /></p>
        <p><label for="email_user">Введите почту</label>
        <input name="email_user" id="email_user" type="email"  /></p>
<?php
    foreach($file as $value)
    {
        $i =1;

        echo "<p style='background-color:#FFCE00;border-radius:5px;text-align: left;'>Вопрос № $n - ".$value['questin']."<br>";
        while($i<=$value['num_quest']){
            echo "<input style='vertical-align:middle;' type='radio' required name=".$m." value=".$i." />".$value[$i]."<br>";
            $i++;
        }
        $n++;
        $m++;
        echo "</p>";
    }
?>
    <input type='text' name='file' value="<?php echo $_GET['quest'] ?>" hidden />
    <p><input class="OK" type="submit" name="OK" value="OK" /></p>
    </form>
    <a href='list.php'>К списку вопросов</a>
</div>
<?php
    }
}
if (isset($_GET['OK'])){
   $file = file_get_contents(__DIR__.'/uploads/'.$_GET['file'], "r");
   $file = json_decode($file, true);
   $quant_quest = $file[0]['quant_quest'];
   $i =0;
   $n = 1;
   $name_user = $_GET['name_user'];
   echo "Ваше имя - ".$_GET['name_user']."<br>";
   if ($_GET['email_user']){
    echo "Ваше почта - ".$_GET['email_user']."<br>";
   }
?>
   <p>Ниже Ваш сертификат</p>
    <img width="200" src="sert.php?name=<?php echo $name_user?>" />
<?php   
   echo "<p><h1>".$file[0]['test_name']."</h1></p>";
        while($i<$quant_quest){
            if ($file[$i]['right_answer']==$_GET[$i]){
                echo "Ответ на вопрос № ".$n." верный<br>";
            }else{echo "Ответ на вопрос № ".$n." не верный<br>";}
        $i++;
        $n++;
        }
        echo "<p><a href='list.php'>К списку вопросов</a></p>";
}
?>


</section>
</body>
</html>