<?php 
$servername ="localhost";
$username ="root";
$password ="";
$database = "to-do";
$conn = new mysqli($servername,$username,$password,$database);
if(!$conn){
die( "lathos");
}
else { echo "connected";}
if (isset($_POST['submit'])){
$text = $_POST['name'];
$sql = "INSERT INTO tasks(task) values ('$text')";
if ($conn->query($sql) === TRUE) {
echo "New record created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;}}
if (isset($_GET['del_task'])) {
$id = $_GET['del_task'];
mysqli_query($conn, "DELETE FROM tasks WHERE id=$id");
} else {echo"";}
$sql = "SELECT id,task FROM tasks";
$result = $conn->query($sql);
if (!$result){ echo "problem";}
?>
<!DOCTYPE html>
<html>
<head>
<title>This is a to-do list!</title>
<style>
.text{display: block;
margin-right: auto;
margin-left: auto; 
margin-top:100px;}

.submit{display:block;
margin-right: auto;
margin-left: auto; 
}
</style>
</head>
<body>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
		<input type="text" class ="text" name="name" >
     <input type="submit" class="submit" name="submit">
</form>
<div class="tasks">
<?php if ($result->num_rows > 0) {
  $i=1;  while($row = $result->fetch_assoc()){?>
  <ul><li> <?php echo $i; echo " "; echo $row["task"]; ?> </li><li> <a href="index.php?del_task=<?php 
  echo $row['id']; ?>">x</a></li></ul>
 <?php $i++;}
} else {
echo "0 results";
}
$conn->close(); ?>
</div>
</body>
</html>
