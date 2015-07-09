<html>
<body>
<pre>
<?php

$trucks=Array( //array=trucks
			Array(	"KrAZ", //array=truck
					"Kremenchuk",
					"Ukraine",
					Array(	Array("KrAZ-65055","6x6","330Hp"), //array=vehicle
							Array("KrAZ-6130C4","6x6","330Hp"),
							Array("KrAZ-5133H2","4x2","330Hp"),
							Array("KrAZ-7140H6","8x6","400Hp")
						  )
				  ),
			Array(	"EBIAM",
					"Thessaloniki",
					"Greece",
					Array(	Array("EBIAM MVM","4x4","86Hp")
						  )
				  ),
			Array(	"KaMAZ",
					"Naberezhnye Chelny",
					"Tatarstan",
					Array(	Array("KAMAZ 54115","6x4","240Hp"),
							Array("KAMAZ 6560","8x8","400Hp"),
							Array("KAMAZ 5460","8x8","340Hp")
						  )
				  ),
			Array(	"LIAZ",
					"Rynovice",
					"Czechoslovakia",
					Array(	Array("LIAZ 706 RT","2x4","160Hp")
						  )
				  ),
			Array(	"IRUM",
					"Brasov",
					"Romania",
					Array(	Array("TAF 690","2x4","90Hp")
						  )
				  ),
			Array(	"MAZ",
					"Minsk",
					"Belarus",
					Array(	Array("MAZ 535","8x8","375Hp"),
							Array("MAZ 7310","8x8","525Hp"),
							Array("MAZ 7907","4x12","1250Hp"),
							Array("MAZ 6317","6x6","425Hp"),
							Array("MAZ 6430","6x6","360Hp"),	
							Array("MAZ 5551","4x2","160Hp")																																													
						  )
				  ),
			Array(	"BelAz",
					"Zohodino",
					"Belarus",
					Array(	Array("Belaz 75600","4x4","3400Hp")
						  )
				  ),
			Array(	"Oshkosh",
					"Oshkosh",
					"USA",
					Array(	Array("Oshkosh P-15","8x8","840Hp"),
							Array("Oshkosh MK-36","6x6","425Hp")
						  )
				  ),
			Array(	"Tatra",
					"Koprivnice",
					"Czechoslovakia",
					Array(	Array("Tatra T 813","4x4","266Hp"),
							Array("Tatra T 815","10x10","436Hp"),
						  )
				  )
);

		$countries=Array(); //Loopen under tar fram varje land som sedan kommer att ligga i listan och sparar detta i denna array.

		foreach($trucks as $truck){
				// Is the key $truck[2] i.e. the country name set in the array $countries or not?
				// If not this means that this country does not exist in the array and therefore should be added to the array
				// This creates a list of countries without duplicates
				if(!isset($countries[$truck[2]])){
						$countries[$truck[2]]=$truck[2];
				}
		}

		if(isset($_POST['country'])){                                                                                                                      
			$showcountry=$_POST['country'];                                                                                                                 
		}else{                                                                                                                                             
			$showcountry="Ukraine";                                                                                                                                
		}  
		
		// For each country create an option tag for the select named country
		echo "<form method='post' action='b.php'><select name='country' onchange='this.form.submit()'>";
		foreach($countries as $country){
			if($showcountry==$country){
				echo "<option selected='selected'>".$country."</option>";
			}
			else{
				echo "<option>".$country."</option>";
			}
		}	
		echo "</select></form>";

		// This is where the new code goes!
		echo "<br /><table border='5'>";
		echo "<tr><th colspan='5' style='background-color:#ffd35b'><div style='text-transform:uppercase'>".$showcountry."</div></th></tr>";
		echo "<tr style='background-color:#ffeec2'><th>City</th><th>Manufacturer</th><th>Model</th><th>Wheels</th><th>Engine</th></tr>";                                                                                                                                                                                                                                                                       
		foreach($trucks as $truck){
			if($truck[2]==$showcountry){
				$i=1;
				foreach($truck[3] as $vehicle){
					if($i % 2){
						echo "<tr style='background-color:#c2dfff'>";
					}
					else{
						echo "<tr style='background-color:#e5f1ff'>";
					}
					echo "<td>".$truck[1]."</td>";
					echo "<td>".$truck[0]."</td>";
					echo "<td>".$vehicle[0]."</td>";
					echo "<td text-align:center'>".$vehicle[1]."</td>";
					echo "<td text-align:center'>".$vehicle[2]."</td>";
					echo "</tr>";
					$i++;
				}
			}
		}
		echo "</table><br />";
		
		//print_r($countries);																								
?>
</pre>
</body>
</html>