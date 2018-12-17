<?php
//这个php文件的作用是获取用户在前端输入的值，并且存储到数据库中，其中line4-8是在获取前端用户输入的值，并赋值给相应变量；line10-17是在连接数据库并往其中的表单增添数据

     $name = $_POST["name"];
     $age = $_POST["age"];
     $sex = $_POST["sex"];
     $area = $_POST["area"];
     $comments = $_POST["comments"];

     $sql_connection = mysqli_connect("localhost", "root","","management")or die("error connecting to MySQL database");//连接数据库database
     $query = "INSERT INTO suggestions(
               name, age, sex, area,comments)
              VALUES(
              '$name','$age','$sex','$area','$comments')";//往表单table增添一条数据
    
    mysqli_query($sql_connection, $query) or die("error quering database");
    mysqli_close($sql_connection);


?>