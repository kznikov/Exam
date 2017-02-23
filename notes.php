<?php 
	if(isset($_GET['link'])){
		if($_GET['link'] === "sorted"){
			header('Location:sorted.php');
		}
	}
	
	function myErrorHandler($namem ,$massege){
		echo "<p style='color:red;'>Priority is invalid!!!</p>";
	}
	
	set_error_handler("myErrorHandler");
?>	
	
			
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<style>
	
		ul, li{
			list-style-type: none;
		}
		
		img{
			width:10px;
			height:10px;
	
		}
	
	</style>
	<title>Notes</title>
</head>
	<body>
		<form action="notes.php" method="post">
			<label>Note:</label>
			<input name="note" type="text"/><br/>
			<label>Priority:</label>
			<input name="prior" type="text"/><br/>
			<input name="Submit" type="submit" value="Add"/><br/>
		</form>
		<form action="notes.php" method="post">
			<label>Number of note:</label>
			<input name="delnote" type="text"/><br/>
			<input name="Submit2" type="submit" value="Delete"/><br/>
		</form>
		
		<a href="?link=sorted">Sorted</a>
		
		<?php 
			
		
			
			$arr1 = array();
			if(isset($_POST['Submit2'])){
				$handle = fopen("./notes.txt", "r+");
				$number = $_POST['delnote']+0;
					while(!feof($handle)){
						$line = fgets($handle);
						array_push($arr1,$line);
					}
					array_splice($arr1, $number-1, 1); 
					
					fseek($handle, 0);
					file_put_contents("notes.txt", "");
					foreach ($arr1 as $note) {
						fwrite($handle, $note);
					}
					fclose($handle);
/*				$file = file_get_contents("notes.txt");
				echo $file;
				$arr1 = explode("\n", $file);
				$arr1 = array_splice($arr1, $number-1, 1);
				fseek($handle, 0);
				fwrite($handle, implode("\n", $arr1));*/
			}
			
			$handle = fopen("./notes.txt", "a+");
			if(isset($_POST['Submit'])){
				$newLine = $_POST['note'];
				$priority = $_POST['prior'];
				if(!is_numeric($priority) || !($priority >= 1 && $priority <= 5)){
					trigger_error("Priority is invalid!!!"); 
					die();
				}
				fwrite($handle, $newLine."#$priority"."\n");
				fseek($handle, 0);
			}
				$arr = array();
				
				while(!feof($handle)){
					$line = fgets($handle);
					$arr [] = $line;
				}
				echo "<ul>";
						foreach ($arr as $note){
							if($note != "" && $note != "/n"){
								$substr = (($note{strlen($note)-1} == "\n") ? substr($note, 0, -3) : substr($note, 0, -2));
								$picName = (($note{strlen($note)-1} == "\n") ? $note{strlen($note)-2} : $note{strlen($note)-1});
								echo "<li>".$substr."<img src='".$picName.".png'/></li>";
							}
					}
					echo "</ul>";
				
		?>
		
		
	</body>
</html>
