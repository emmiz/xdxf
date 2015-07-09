<html>
<body>
<pre>
<?PHP
	$dom = new DomDocument;
	$dom->preserveWhiteSpace = FALSE;

	$file = 'example2.xml';
	$loadstate=$dom->load($file);	
	
	$xp = new DOMXPath($dom);
	
	
	//Detta stycke skriver ut hela XML-dokumentet med XPATH.
	$xpathString="//*";
	echo "<b>Example1: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue;//." NodeText: ".$node->textContent."<br>";
	}
	
	//TEST!
	$xpathString="//article";
	echo "<b>Example1: ".$xpathString."</b><br>";
	$headings = $xp->query($xpathString);
	foreach ($headings as $heading) {
  		echo "   Name:".$heading->nodeName." Value:".$heading->nodeValue;//." NodeText: ".$heading->textContent."<br>";
	}
	
	//Detta stycke skapar b�rjan p� min tabell.
	echo "<table border='1'><tr><th colspan='8' style='background-color:#3f63ff; color:#ffffff'><div style='text-transform:uppercase'>Newspapers</div></th></tr>";
	echo "<tr style='background-color:#9baeff'><th>name</th><th>subscribers</th><th>edition</th><th>articleID</th><th>date</th><th>headline</th><th>content</th><th>type</th></tr>";	
	
	//B�rjan p� det som l�g i koden fr�n start.
	$xpathString="//newspaper";									//Denna rad sparar str�ngen "//newspaper" i variabeln $xpathString.
	$papers = $xp->query($xpathString);							//Denna rad skickar med adressen som sparats i $xpathString till en funktion som sen sparar alla taggar som ligger under newspaper och deras inneh�ll i arrayen $papers. 
	foreach ($papers as $paper) {								//Denna rad itererar �ver arrayen $papers och f�r varje tidning h�nder f�ljande....
	
		echo "<tr>";											//En ny tabellrad startas f�r varje tidning.
		$paperAttributes = $paper->attributes;					//Attributen sparas i arrayen $paperAttributes.
		foreach ($paperAttributes as $index=>$attr) {
			echo "<td rowspan='3'>".$attr->value."</td>";		//Varje attribut skrivs ut i en cell.
		}
		
		$innerdom = new DomDocument;							//
		$otherxml=$dom->saveXML($paper);						//Detta stycke skapar en inre XPATH-v�g som kommer anv�ndas nedan.
		$innerdom->loadXML($otherxml);							//
		$innerxp = new DOMXPath($innerdom);						//
		
		$xpathString="//article";								//Denna rad sparar str�ngen "//article" i variabeln $xpathString.
		$articles = $innerxp->query($xpathString);				//Denna rad skickar med adressen som sparats i $xpathString till en funktion som sen sparar alla taggar som ligger under newspaper och deras inneh�ll i arrayen $articles. 
		
		foreach ($articles as $article) {						//Denna rad itererar �ver arrayen $articles och f�r varje artikel h�nder f�ljande....
			$articleAttributes = $article->attributes;			//Attributen sparas i arrayen $paperAttributes.
			foreach ($articleAttributes as $index=>$attr) {		
				echo "<td>".$attr->value."</td>";				//Varje attribut skrivs ut i en cell.
				if($articleAttributes->item(1)==""){
					echo "<td style='color:grey'><div align=center>no date</div></td>";	//Om datumf�ltet �r tomt skrivs detta ut.
				}
			}

			// $articleNodes = $article->nodeValue;
			// echo "<td>hej ".$articleNodes."</td>";
			
			$innerstdom = new DomDocument;							//
			$thirdxml=$dom->saveXML($paper);						//Detta stycke skapar en inre XPATH-v�g som kommer anv�ndas nedan.
			$innerstdom->loadXML($thirdxml);						//
			$innerstxp = new DOMXPath($innerstdom);					//
			
			$xpathString="//heading";
			$headings = $innerstxp->query($xpathString);
			// foreach($headings as $heading){
				// $headingNodes = $heading->nodeValue;
				// echo "<td>".$headingNodes."</td>";
			// }
			$heading="&nbsp";
			$text="&nbsp";
			$comment="&nbsp";
			
			//$headingNodes = $headings->nodeValue;
			echo "<td>".$heading."</td>";
			echo "<td>".$text."</td>";
			echo "<td>".$comment."</td></tr>";
		}
		
		//echo "</tr>";
		
	}
	
	//Slut p� tabell!
	echo "</tr></table>";
?>
</pre>
</body>
</html>