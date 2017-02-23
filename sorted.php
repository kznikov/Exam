<?php 

	if(isset($_GET['link'])){
		if($_GET['link'] === "home"){
			header('Location:notes.php');
		}
	}

	function myErrorHandler($namem ,$massege){

	}
	
	set_error_handler("myErrorHandler");
	
	

?>



<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Pangolin" rel="stylesheet">
	<style>
	
		@font-face {
		   font-family: 'Pangolin', cursive;
		   
		}
	
		table, th, td, tr{
			font-family: 'Pangolin', cursive;
			border: 2px solid black;
		}
	
	</style>
	<title>Sorted</title>
</head>
	<body>
		<?php 
		
			function sortByOption($a, $b) {
				return strcmp($a[1], $b[1]);
			 }


		$handle = fopen("./notes.txt", "r");
		$arr1 = array(array());
		while(!feof($handle)){
			$line = fgets($handle);
			$arr = explode("#", $line);
			$arr[1] = str_replace("\n", "", $arr[1]);
			$arr1[] = $arr;
		}
		usort($arr1, 'sortByOption');
	
		while(!feof($handle)){
			$line = fgets($handle);
			$arr [] = $line;
		}
		echo "<table>";
		echo "<th>Note</th>";
		echo "<th>Priority</th>";
		foreach ($arr1 as $value){
			echo "<tr>";
			if($value[1] == 1 || $value[1] == 2){
				echo "<td style='color:green;'>".$value[0]."</td>";
				echo "<td style='color:green;'>".$value[1]."</td>";
				echo "</tr>";
			}
			if($value[1] == 3 || $value[1] == 4){
				echo "<td style='color:yellow;'>".$value[0]."</td>";
				echo "<td style='color:yellow;'>".$value[1]."</td>";
				echo "</tr>";
			}
			if($value[1] == 5){
				echo "<td style='color:red;'>".$value[0]."</td>";
				echo "<td style='color:red;'>".$value[1]."</td>";
				echo "</tr>";
			}

			
			
		}
		echo "</table>";
?>

<a href="?link=home">Home</a>
		
	</body>
</html>

