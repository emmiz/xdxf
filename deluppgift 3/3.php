<html>
<body>
<pre>
<?php

	$file = 'example2.xml';
	
	$dom = new DomDocument;
	$dom->preserveWhiteSpace = FALSE;
	$dom->load($file);
	
	echo "<br>";
	echo "<table border='1'>";
	echo	"<tr>";
	echo		"<th colspan='8' style='background-color:#3f63ff; color:#ffffff'><div style='text-transform:uppercase'>Newspapers</div></th>";
	echo	"</tr>";
	echo	"<tr style='background-color:#9baeff'>";
	echo		"<th width='90'>name</th><th>subscribers</th><th width='130'>edition</th><th>articleID</th><th>date</th><th width='267'>headline</th><th>content</th><th>type</th>";
	echo	"</tr>";
	
	$papers = $dom->getElementsByTagName('newspaper');		//Denna rad sparar varje tagg som heter "newspaper" och dess innehåll i arrayen $papers.
	foreach ($papers as $paper){
		echo $paper->tagName."<br>"; 						//Denna rad skriver ut taggnamnet på varje nod i arrayen $papers i den övre texten.
		echo "<tr>";										//Denna rad skapar en ny tabellrad för varje tidning.
		
		$paperAttributes = $paper->attributes;
		foreach ($paperAttributes as $index=>$attr) {		//Denna rad gör det möjligt att skriva ut attributen i newspaper-taggen.
			echo "<td rowspan='3'>".$attr->value."</td>";
		}
		
		foreach ($paper->childNodes as $child){				//Denna rad itererar över varje newspaper-tagg och sparar barntaggen "article" och dess innehåll i arrayen $child.
			echo " ".$child->tagName;						//Denna rad skriver ut taggnamnet på varje nod i arrayen $child i den övre texten. 

			$attributes = $child->attributes;				//På denna rad sparas article's attribut och dess innehåll i arrayen $attributes.	
			foreach ($attributes as $index=>$attr) {		//Denna rad gör det möjligt att skriva ut attributen i article-taggen.
				echo " ".$attr->name."=".$attr->value;		//Denna rad skriver ut attributnamnet och attributvärdet på varje nod i arrayen $attributes i den övre texten.
				if($attr->name=="id"){
					echo "<td>".$attr->value."</td>";
				}
				if($attr->name!="id"){
					echo "<td>".$attr->value."</td>";
				}
				if($attributes->item(1)==""){
					echo "<td style='color:grey'><div align=center>no date</div></td>";
				}
			}
			
			foreach ($child->childNodes as $children){		//Denna rad sparar barntaggarna till article (heading,text,comment) i arrayen $children.
				
				if($children->tagName=="heading"){
					echo "<td>".$children->nodeValue."</td>";
				}
				if($children->tagName=="text"){
					echo "<td>".$children->nodeValue."</td>";
				}
				if($child->lastChild->nodeName=="comment"){
					echo "<td>&nbsp;</td>";
				//if($children->tagName=="comment"){
					// $childrenAttributes = $children->attributes;
					// foreach ($childrenAttributes as $cIndex=>$cAttr) {		//Denna rad gör det möjligt att skriva ut attributen i comment-taggen.
						// if($childrenAttributes->item(0)!=""){
							// echo "<td>".$cAttr->value."</td>";
						// }
						// else{
							// echo "<td>&nbsp;</td>";
						// }
					// }
				}
			}
			echo "</tr>";
			echo "    <br>".$child->nodeValue."<br>";		//Denna rad skriver ut taggvärdet på varje nod i arrayen $child i den övre texten.
	  	}
	}
	echo "<tr><td colspan='8'>&nbsp;";
	if ($child->firstChild->nodeName=="heading"){
		echo "hej";
	}
	
	echo "</td></tr>";
	echo "</table>";
?>
</pre>
</body>
</html>