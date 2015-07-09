<html>
<body>
<pre>
<?PHP
	$dom = new DomDocument;
	$dom->preserveWhiteSpace = FALSE;

	$file = 'example1b.xml';
	$loadstate=$dom->load($file);	
	
	$xp = new DOMXPath($dom);
	
	$xpathString="/person";
	echo "<b>Example1: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="/person/*";
	echo "<b>Example2: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="/person/address";
	echo "<b>Example3: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="/person/address[@street='12th']";
	echo "<b>Example4: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="/person/car/color[text()='Teal!!']";
	echo "<b>Example5: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="/person/car/color[text()='Teal!!']/..";
	echo "<b>Example6: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="//color[text()='Teal!!']/..";
	echo "<b>Example7: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }

	$xpathString="//*";
	echo "<b>Example8: ".$xpathString."</b><br>";
	$nodes = $xp->query($xpathString);
	foreach ($nodes as $node) {
  		echo "   Name:".$node->nodeName." Value:".$node->nodeValue." NodeText: ".$node->textContent."<br>";
  }
  
?>
</pre>
</body>
</html>