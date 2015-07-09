<html>
<body>
<pre>
<?php

		$pixelsizes=Array("10","20","30","40");
		$fontcolor=Array("red","blue","yellow","green","pink");
		$fontweight=Array("thin","normal","bold");
		
		if(isset($_POST['textbox'])){                                                                                                                      
		$textboxvalue=$_POST['textbox'];                                                                                                                 
		}else{                                                                                                                                             
		$textboxvalue="";                                                                                                                                
		}
		
		echo "<form method='post' action='a.php'>";

		// The code iterates over the array $pixelsizes and creates corresponding option tags
		echo "<select name='pixelsize'>";
		foreach($pixelsizes as $pixelsize){
				echo "<option>".$pixelsize;
		}
		echo "</select>";

		// The code iterates over the array $fontcolor and creates corresponding option tags
		echo "<select name='color'>";
		foreach($fontcolor as $color){
				echo "<option>".$color;
		}
		echo "</select>";
		
		// The code iterates over the array $fontweight and creates corresponding option tags
		echo "<select name='weight'>";
		foreach($fontweight as $weight){
				echo "<option>".$weight;
		}
		echo "</select>";
		
		echo "<input type='text' name='textbox' value='$textboxvalue'>"; 
		
		echo "<input type='submit' value='Ok!'>";

		echo "</form>";

		// This is where the new code goes!?
	
		print_r($_POST);
		echo "<br><br>";
	
		if(isset($_POST['pixelsize'])){
				$pixelsize=$_POST['pixelsize'];
		}else{
				$pixelsize="5";
		}
		
		if(isset($_POST['color'])){
				$color=$_POST['color'];
		}else{
				$color="red";
		}
		
		if(isset($_POST['weight'])){
				$weight=$_POST['weight'];
		}else{
				$weight="normal";
		}
		
		echo "<br><br>";
		
		echo "<div style='font-size:".$pixelsize."px; color:".$color."; font-weight:".$weight."'>".$textboxvalue."</div>";													

?>
</pre>
</body>
</html>

