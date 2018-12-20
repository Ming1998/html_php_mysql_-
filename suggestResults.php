<!DOCTYPE HTML>
<html>
<!--这个展示php实际上有两个功能，搜索信息和echo信息，line10-16是在获取用户在前端输入的keyword（如果不输就默认显示全部信息），line19-30就是在建立获取到的keyword与数据库的连接-->
   <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   </head>

   <body class="container">
<form class="form-inline" method="post"><!--这个表单的目的是获取用户输入的keyword，见line24，method="post"不要忘了-->
  <div class="form-group">
    <label for="keyword">姓名</label>
    <input type="text" class="form-control" name="keyword" id="keyword">
  </div>
  <button type="submit" name="btn-submit" class="btn btn-default">搜索</button><!--这里的name值要与line22对应-->
</form>    
<?php
//这个query函数的作用是通过判断输入框有没有输入内容，从而决定$query的值是数据库中的全部信息（line20）还是部分信息（line25），如果用户不搜索，也就是说line22的判断语句中用户输入的值为空，那么$query是数据库全部信息
function query(){
$query = "SELECT * FROM suggestions";

if(isset($_POST['btn-submit']))//这个isset函数是为了防止用户不输入时报错
{
  $keyword=$_POST['keyword'];
  return $query = "SELECT * FROM suggestions WHERE name LIKE '%$keyword%' ";
}
  return $query; //返回$query值
}

$query=query();//line19-28是定义函数，并没有运行，在这里我们运行query函数并且返回$query值，赋值给变量$query

$sql_connection = mysqli_connect("localhost", "root","","management")or die("error connecting to MySQL database");//这一步是在连接数据库

$result = mysqli_query($sql_connection, $query);//这一步是在获取数据库的信息

echo '<ul class="list-group">';
while($row = mysqli_fetch_array($result)){//whlie循环遍历每一条数据，并将其中符合$query的信息打印
    $name = $row['name'];
    $age = $row['age'];
    $sex = $row['sex'];
    $area = $row['area'];
    $comments = $row['comments'];
    echo '<li class="list-group-item">';
    echo '姓名:<strong class="text-muted"> '. $name. '</strong> <br>';
    echo '年龄:<strong class="text-muted"> '. $age. '</strong> <br>';
    echo '性别:<strong class="text-muted"> '.$sex . '</strong><br>';
    echo '领域:<strong class="text-muted"> '. $area . '</strong> <br>';
    echo '建议:<strong class="text-muted"> '. $comments . '</strong> <br>';
	echo '</li>';

}
echo '</ul>';

mysqli_close($sql_connection);//结束进程
?>
</body>
</html>
