<html>
<body>
<?php

	$xslDoc = new DOMDocument();
	$xslDoc->load("7.xsl");

	$xmlDoc = new DOMDocument();
	$xmlDoc->load("example2.xml");

	$proc = new XSLTProcessor();
	$proc->importStylesheet($xslDoc);

	$proc = new XSLTProcessor();				//En xslt-processor sparas i variabeln $proc.
	$proc->importStylesheet($xslDoc);			//Jag k�r metoden importStylesheet p� xslt-processorn $proc och skickar med XSL-dokumentet som sparats i $xslDoc.

	//Detta stycke skapar b�rjan p� min tabell.
	echo "<table border='1'><tr><th colspan='8' style='background-color:#3f63ff; color:#ffffff'><div style='text-transform:uppercase'>Newspapers</div></th></tr>";
	echo "<tr style='background-color:#9baeff'><th>name</th><th>subscribers</th><th>edition</th><th>articleID</th><th>date</th><th>headline</th><th>content</th><th>type</th></tr>";	

	echo $proc->transformToXML($xmlDoc);		//H�r kopplas stylesheet och xml ihop via metoden transformToXML och skrivs sedan ut.

	//Slut p� tabell!
	echo "</tr></table>";

?>
</body>
</html>