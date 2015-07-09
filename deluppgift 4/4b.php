<html>
<body>
<pre>
<?php

function HandleXmlError($errno, $errstr, $errfile, $errline)
{
 		echo $errno." ".$errstr."<br>";
}

	$file = 'example2b.xml';

	$dom = new DomDocument;
	$dom->preserveWhiteSpace = FALSE;
	
	set_error_handler('HandleXmlError');
	$loadstate=$dom->load($file);
	if($loadstate){
			$validatestate=$dom->validate();	
			if($validatestate){
					echo "Validation successful!<br>";
			}else{
					echo "Validation test failed!<br>";
			}			
	}else{
			echo "Well-formedness test Failed!<br>";	
	}
	restore_error_handler();
	
?>
</pre>
</body>
</html>