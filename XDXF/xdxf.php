<html>
<head>
	<!-- <link href="xdxf.css" rel="stylesheet" type="text/css" /> -->
</head>
<body>
<?php
	include('stylearray.php'); //Denna rad inkluderar PHP-filen som styr layouten p� sidan.
	
	//Rad 10-32 anv�nds till DTD-valideringen!
	function HandleXmlError($errno, $errstr, $errfile, $errline)
	{
		echo $errno." ".$errstr."<br>";
	}
	
	$file = 'xdxf.xml';
	
	$dom = new DomDocument;
	$dom->preserveWhiteSpace = FALSE;
	
	set_error_handler('HandleXmlError');
	$loadstate=$dom->load($file);
	if($loadstate){
		$validatestate=$dom->validate();	
		if($validatestate){
				echo "<div class='validate'>Validation of DTD successful!</div>";
		}else{
				echo "<div class='validate'>Validation of DTD-test failed!</div><br/>";
		}			
	}else{
		echo "<div class='validate'>Well-formedness test Failed!</div><br/>";	
	}
	restore_error_handler();
	
	//Rad 35-40 anv�nds f�r att skapa layoutalternativstaggar som skall kunna v�ljas mellan.
	echo "<div id='colors'>";
	echo "Choose your preferred color-scheme: ";
	while(list($key, $val) = each($styleSheets)){
		echo "<a href='styleswitcher.php?SETSTYLE=".$key."'>".$val["name"]."</a> ";
	}
	echo "</div>";
	
	$xslDoc = new DOMDocument();
	$xslDoc->load("xdxf.xsl");

	$xmlDoc = new DOMDocument();
	$xmlDoc->load("xdxf.xml");

	$proc = new XSLTProcessor();			//En xslt-processor sparas i variabeln $proc.
	$proc->importStylesheet($xslDoc);		//Jag k�r metoden importStylesheet p� xslt-processorn $proc och skickar med XSL-dokumentet som sparats i $xslDoc.

	echo "<table>";							//Detta stycke skapar b�rjan p� min tabell.

	echo $proc->transformToXML($xmlDoc);	//H�r kopplas stylesheet och xml ihop via metoden transformToXML och skrivs sedan ut.

	echo "</table>";						//Slut p� tabell!
?>
</body>
</html>