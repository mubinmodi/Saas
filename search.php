<?php
$tg=array();
$x=0;
$img= array();
$db = mysqli_connect('localhost', 'root', '', 'SaaS');
$output='';
if(isset($_POST['search'])){
	$searchq=$_POST['search'];
	$searchq=preg_replace("#[^0-9a-z]#i", "",$searchq);

	$query= mysqli_query($db,"SELECT * from image where tag LIKE '%$searchq%'") or die("could not search");
	$count = mysqli_num_rows($query);
	if($count == 0){
		$output = 'there was no result';

	}
	else{
		while($row=mysqli_fetch_array($query)){
			$tag1=$row['tag'];
			$x++;

			array_push($tg,'<div>'.$tag1.'</div>');
			array_push($img," <img src='" . $row['path'] . "' height='200px' width='200px'> ");
		}

	}

}
?>
<html>
<style>


.header {
width: 55%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
form, .content {
	width:50%;
  margin: 0px auto;
  padding: 40px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 0px 0px 10px 10px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: #f2dede; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
body{
  background-image: url('saas.jpg');
}

</style>
<body>

<div class="header">
	<h1>Search Images</h1>
</div>
<form method="post" action="index.php">
<?php	echo" <table border=2>";
		echo"<tr> \n";
		echo"<th>Tags</th>";
		echo"<th>Images</th>";
		echo"</tr>";
		for($y=0; $y<$x; $y++){
		echo"<tr> \n";
		echo"<td>"; echo"$tg[$y]"; echo"</td>";
		echo"<td>"; echo"$img[$y]"; echo"</td>";
		echo"</tr>";
		}
	echo"</table>";
	?>

<button type="submit" class="btn" name="login_user">Home Page</button>
</form>
</body>
</html>
