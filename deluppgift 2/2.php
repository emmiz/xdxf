<html>
	<body>
		<pre>
		<?php

		    function startElement($parser, $entityname, $attributes) {
						global $indent;
						$line = xml_get_current_line_number($parser);
						echo $line." ";
						for($i=0;$i<$indent;$i++) echo "   ";
						$indent++;
						echo "&lt;".$entityname;
						foreach ($attributes as $attname => $attvalue) {
							if($attname=='NAME'){
								echo "<td rowspan='3' width='90'>".$attvalue."</td>";
							}
							if($attname=='SUBSCRIBERS'){
								echo "<td rowspan='3'>".$attvalue."</td>";
							}
							if($attname=='TYPE'){
								echo "<td rowspan='3'>".$attvalue."</td>";
							}
							if($attname=='ID'){
								echo "<td>".$attvalue."</td>";
								if(isset($attributes['TIME'])){
									echo "<td>".$attributes['TIME']."</td>";
								}
								else{
									echo "<td style='color:grey'><div align=center>no date</div></td>";
								}
								//if(isset($attributes['DESCRIPTION'])){
								//	echo "<td>".$attributes['DESCRIPTION']."</td>";
								//}
								//else{
								//	echo "<td style='color:grey'><div align=center>no type</div></td>";
								//}
							}
							if($entityname=='COMMENT'){
								echo "<td>".$attributes['DESCRIPTION']."</td>";
							}
							echo " ".$attname."='".$attvalue."'";
						}
						
						//foreach ($attributes as $attname => $attvalue) {
						//	echo "<td>";
						//		if($attname=='DESCRIPTION'){
						//			echo "<td>".$entityname."</td>";
						//		}
						//		else{
						//			echo "<td style='color:grey'><div align=center>no comment</div></td>";
						//		}
						//	echo "</td>";
						//}
						//if($entityname=='COMMENT'){
						//	foreach ($attributes as $attname => $attvalue) {
						//		if($attname=='NAME'){
						//			echo "<td>".$entityname."</td>";
						//		}
						//	}
						//}
						//echo "<td style='color:grey'>";
						//	echo "&nbsp;";
							//if(!$attname=='DESCRIPTION'){
							//	echo "<div align=center>no comment</div>";
							//}
							//else{
							//	echo $attvalue;
							//}
						//	echo "</td></tr><tr>";
						echo "&gt;<br>";
						print_r($attributes);
			}

			function endElement($parser, $entityname) {
						global $indent;
						$line = xml_get_current_line_number($parser);
						echo $line." ";
						$indent--;
						for($i=0;$i<$indent;$i++) echo "   ";      
						echo "&lt;/".$entityname."&gt;<br>";
						if($entityname=='ARTICLE'){
							echo "</tr><tr>";
						}
			}

			function charData($parser, $chardata) {
						global $indent;
						$line = xml_get_current_line_number($parser);
						$chardata=trim($chardata);
						if($chardata=="") return;
						echo $line." ";
						for($i=0;$i<$indent;$i++) echo "   ";
						echo $chardata."<br>";
						
						//foreach($chardata){
							//if($charname=='HEADING'){
								echo "<td>".$chardata."</td>";
							//}
							//else{
							//	echo "<td style='color:grey'><div align=center>no data</div></td>";
							//}
						//}
						//echo "</tr>";
			}

			$parser = xml_parser_create();
			$indent = 0;
			xml_set_element_handler($parser, "startElement", "endElement");
			xml_set_character_data_handler($parser, "charData");

			$file = 'example2.xml';
			$data = file_get_contents($file);
			echo "<table border='1' align=center><tr><th colspan='8' style='background-color:#3f63ff; color:#ffffff'>NEWSPAPERS</th></tr>";
			echo "<tr style='background-color:#9baeff'><th>name</th><th>subscribers</th><th>edition</th><th>articleID</th><th>date</th><th>headline</th><th>content</th><th>type</th></tr>";
			echo "<tr>";
			if(!xml_parse($parser, $data, true)){
				printf("<P> Error %s at line %d</P>", xml_error_string(xml_get_error_code($parser)),xml_get_current_line_number($parser));
			}else{
				print "<br>Parsing Complete!</br>";
			}
			
			
			echo "</tr></table>";
			xml_parser_free($parser);
		?>
		</pre>
	</body>
</html>
