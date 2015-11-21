<html>
	<style>
		.comment{
			border:black solid 1px;
			margin:5px;
			padding:5px;
		}
		.comment > div{
			margin-left:20px;
		}
	</style>
	
<?php
	require("/php/config.php");
	require("/php/functions.php");
	
	f_sqlConnect(DB_USER, DB_PASSWORD, DB_NAME);
	
	echo readcomments("0");
	
	function readcomments($parentid){
		$returnstring = "";
		$sql = "SELECT * FROM testcomments WHERE parentid = '" . $parentid ."' ORDER BY upvotes DESC";
		$queryresult = mysql_query($sql);
		
		if(!$queryresult){
			die("Error: " . mysql_error());
		}
		
		while($row = mysql_fetch_array($queryresult)){
			$id = $row["id"];
			$parentid = $row["parentid"];
			$upvotes = $row["upvotes"];
			$content = $row["content"];
			
			$returnedstring .= "<div class='comment'>ID: " . $id . " Parent ID: " . $parentid . " Upvotes " . $upvotes . "<p>" . $content . "</p>";
			$returnedstring .= readcomments($id);
		}
		
		return $returnedstring . "</div>";
	}
?>

</html>
