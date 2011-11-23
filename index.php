<form action="" method="GET">

<input type="text" name="shelves" value="0" />
<br />
<?php
$items = array(
"256" => array("Iron Shovel","iron","spade"),
"257" => array("Iron Pickaxe","iron","pickaxe"),
"258" => array("Iron Axe","iron","axe"),
"267" => array("Iron Sword","iron","sword"),
"268" => array("Wooden Sword","wood","sword"),
"269" => array("Wooden Shovel","wood","spade"),
"270" => array("Wooden Pickaxe","wood","pickaxe"),
"271" => array("Wooden Axe","wood","axe"),
"272" => array("Stone Sword","stone","sword"),
"273" => array("Stone Shovel","stone","spade"),
"274" => array("Stone Pickaxe","stone","pickaxe"),
"275" => array("Stone Axe","stone","axe"),
"276" => array("Diamond Sword","diamond","sword"),
"277" => array("Diamond Shovel","diamond","spade"),
"278" => array("Diamond Pickaxe","diamond","pickaxe"),
"279" => array("Diamond Axe","diamond","axe"),
"283" => array("Gold Sword","gold","sword"),
"284" => array("Gold Shovel","gold","spade"),
"285" => array("Gold Pickaxe","gold","pickaxe"),
"286" => array("Gold Axe","gold","axe"),
"298" => array("Leather Cap","leather","helmet"),
"299" => array("Leather Tunic","leather","chest"),
"300" => array("Leather Pants","leather","legs"),
"301" => array("Leather Boots","leather","boots"),
"302" => array("Chain Helmet","chain","helmet"),
"303" => array("Chain Chestplate","chain","chest"),
"304" => array("Chain Leggings","chain","legs"),
"305" => array("Chain Boots","chain","boots"),
"306" => array("Iron Helmet","iron","helmet"),
"307" => array("Iron Chestplate","iron","chest"),
"308" => array("Iron Leggings","iron","legs"),
"309" => array("Iron Boots","iron","boots"),
"310" => array("Diamond Helmet","diamon","helmet"),
"311" => array("Diamond Chestplate","diamond","chest"),
"312" => array("Diamond Leggings","diamond","legs"),
"313" => array("Diamond Boots","diamond","boots"),
"314" => array("Gold Helmet","gold","helmet"),
"315" => array("Gold Chestplate","gold","chest"),
"316" => array("Gold Leggings","gold","legs"),
"317" => array("Gold Boots","gold","boots")
);
foreach($items as $id => $info){
	echo "<input type='radio' name='item' value='".$id."' /><img src='images/".$info[2]."_".$info[1].".jpg"'><br />";
}
?>
</select>

</form>

<?php
if(isset($_GET['shelves']) && isset($_GET['itemID'])){
	
	global $shelves,$tool_material,$tool_type_specific,$types,$tool_type,$e_tool_type,$enchantability,$powers,$weights,$slot_factors;
	
	$shelves = 30;						// define number of shelves. Should be variable and defined by the user
	$tool_material = "gold";			// item material
	$tool_type_specific = "sword";
	
	
	
	
	$types = array("helmet" => "armor", "boots" => "armor", "chest" => "armor", "legs" => "armor",
	"sword" => "weapon", "bow" => "weapon",
	"pickaxe" => "tool", "spade" => "tool", "axe" => "tool", "hoe" => "tool");
	
	$tool_type = $types[$tool_type_specific];
	
	$e_tool_type = ($tool_type == "weapon")?"tool":$tool_type;
	$enchantability = array(
		"wood" => 		array("armor" => null,	"tool" => 15),
		"leather" =>	array("armor" => 15,	"tool" => null),
		"stone" =>		array("armor" => null,	"tool" => 5),
		"iron" =>		array("armor" => 9,		"tool" => 14),
		"chain" =>		array("armor" => 12,	"tool" => null),
		"diamond" =>	array("armor" => 10,	"tool" => 10),
		"gold" =>		array("armor" => 25,	"tool" => 22)
	);
	$powers = array(
		"armor" => array(
			"Protection" =>				array(1 => array(1,21), 2 => array(17,37),3 => array(33,53),4 => array(49,69)),
			"Fire Protection" =>		array(1 => array(10,22),2 => array(18,30),3 => array(26,38),4 => array(34,46)),
			"Feather Fall" =>			array(1 => array(5,15), 2 => array(11,21),3 => array(17,27),4 => array(23,33)),
			"Blast Protection" =>		array(1 => array(5,17), 2 => array(13,25),3 => array(21,33),4 => array(29,41)),
			"Projectile Protection" =>	array(1 => array(3,18), 2 => array(9,24), 3 => array(15,30),4 => array(21,36)),
			"Respiration" =>			array(1 => array(10,40),2 => array(20,50),3 => array(30,60)),
			"Aqua Affinity" =>			array(1 => array(1,41)),
		),
		"weapon" => array(
			"Sharpness" =>				array(1 => array(1,21), 2 => array(17,37),3 => array(33,53),4 => array(49,69),5 => array(65,85)),
			"Smite" =>					array(1 => array(5,25), 2 => array(13,33),3 => array(21,41),4 => array(29,49),5 => array(37,57)),
			"Bane of Arthropods" =>		array(1 => array(5,25), 2 => array(13,33),3 => array(21,41),4 => array(22,49),5 => array(37,57)),
			"Knockback" =>				array(1 => array(5,55), 2 => array(25,75)),
			"Fire Aspect" =>			array(1 => array(10,60),2 => array(30,80)),
			"Looting" =>				array(1 => array(20,70),2 => array(32,82),3 => array(44,94)),
		),
		"tool" => array(
			"Efficiency" =>				array(1 => array(1,51), 2 => array(16,66),2 => array(33,81),4 => array(46,96),5 => array(61,111)),
			"Silk Touch" =>				array(1 => array(25,75)),
			"Unbreaking" =>				array(1 => array(5,55), 2 => array(15,65),3 => array(25,75)),
			"Fortune" =>				array(1 => array(20,70),2 => array(32,82),3 => array(44,94)),
		)
	);
	$weights = array(
		"Protection" => 10,
		"Fire Protection" => 5,
		"Feather Fall" => 5,
		"Blast Protection" => 2,
		"Projectile Protection" => 5,
		"Respiration" => 2,
		"Aqua Affinity" => 2,
		
		"Sharpness" => 10,
		"Smite" => 5,
		"Bane of Arthropods" => 5,
		"Knockback" => 5,
		"Fire Aspect" => 2,
		"Looting" => 2,
		
		"Efficiency" => 10,
		"Silk Touch" => 1,
		"Unbreaking" => 5,
		"Fortune" => 2
	);
	if($tool_type_specific !== "boots"){
		unset($powers["armor"]["Feather Fall"]);
		unset($weights["Feather Fall"]);
	}
	if($tool_type_specific !== "helmet"){
		unset($powers["armor"]["Respiration"]);
		unset($weights["Respiration"]);
		unset($powers["armor"]["Aqua Affinity"]);
		unset($weights["Aqua Affinity"]);
	}
	$slot_factors = array(0.5,0.66,1);	// define slot factors
	$shelves = max(0,min($shelves,30));	// constrain number of bookshelves
	
	//echo "<pre>";
	
	echo "<table>";
	echo "<tr><td>Bookshelves:</td><td>".$shelves."</td></tr>";
	echo "<tr><td>Tool material:&nbsp;&nbsp;</td><td>".$tool_material."</td></tr>";
	echo "<tr><td>Tool type:</td><td>".$tool_type_specific."</td></tr>";
	echo "</table>";
	
	echo "<br /><table><tr style='vertical-align:top;'>";
	for($a = 0; $a < 5; $a++){
		echo "<td>";
		genTable();
		echo "</td>";
	}
	echo "</tr></table>";

}


function weight_sort($a,$b){
	return $b[2]-$a[2];
}
function filter_conflicts($possible, &$possibles, $ind){
	//echo "remove ".$possibles[$ind][0]."\n";
	unset($possibles[$ind]);
	if($possible[0] == "Sharpness" || $possible[0] == "Smite" || $possible[0] == "Bane of Arthropods"){
		//echo $possible[0]." damage\n";
		foreach($possibles as $pos => $item){
			if($item[0] == "Sharpness" || $item[0] == "Smite" || $item[0] == "Bane of Arthropods"){
				//echo "  remove ".$item[0]."\n";
				unset($possibles[$pos]);
			}
		}
	}elseif(strpos($possible[0],"Protection") !== false){
		//echo $possible[0]." protection\n";
		foreach($possibles as $pos => $item){
			echo "  check ".$item[0]."\n";
			if(strpos($item[0],"Protection") !== false){
				//echo "  remove ".$item[0]."\n";
				unset($possibles[$pos]);
			}
		}
	}
	$weight = 0;
	foreach($possibles as $p)
		$weight += $p[2];
	return $weight;
}
function genTable(){
	global $shelves,$tool_material,$tool_type_specific,$types,$tool_type,$e_tool_type,$enchantability,$powers,$weights,$slot_factors;
	$chosen_enchants = array();
	$enchant_levels = array();
	for($i=0;$i<3;$i++){
		$level = round((round(rand(1,5)) + round(rand(1,$shelves/2)) + round(rand(1,$shelves))) * $slot_factors[$i]);
		$level += rand(0,$enchantability[$tool_material][$e_tool_type]) + 1;
		$level = round($level*(rand(75,125)/100));
		$enchant_levels[$i+1] = $level;
		
		$possibles = array();
		$total_weight = 0;
		foreach($powers[$tool_type] as $name => $levels){
			// name => array(level => array(bounds)),
			$chosen = null;
			foreach($levels as $l => $bounds){
				if($bounds[0] <= $level && $bounds[1] >= $level){
					$chosen = array($name, $l, $weights[$name]);
				}
			}
			if($chosen != null){
				$possibles[] = $chosen;
				$total_weight += $chosen[2];
			}
		}
		//echo "Possibles (".$tool_type."):\n";
		//print_r($possibles);
		usort($possibles,'weight_sort');
		$picked = rand(0,$total_weight);
		foreach($possibles as $ind => $possible){
			$picked -= $possible[2];
			if($picked <= 0){
				$chosen_enchants[$i+1][] = $possible;
				$total_weight = filter_conflicts($possible,$possibles, $ind);
				break;
			}
		}
		
		//echo "After first pick:\n";
		//print_r($possibles);
		$level = floor($level/2);
		while(!empty($possibles) && rand(1,100) <= (($level+1)/50)*100){
			$picked = rand(0,$total_weight);
			foreach($possibles as $ind => $possible){
				$picked -= $possible[2];
				if($picked <= 0){
					$chosen_enchants[$i+1][] = $possible;
					$total_weight = filter_conflicts($possible,$possibles, $ind);
					break;
				}
			}
		}
		
		
		
	}
	
	echo "<table cellspacing=0>";
	foreach($chosen_enchants as $ind => $chosen){
		echo "<tr><td style='border:1px solid black;border-right:none; width:200px;'>";
		foreach($chosen as $enchant){
			echo $enchant[0]." ".$enchant[1]."<br />";
		}
		echo "</td><td style='border:1px solid black;border-left:none;vertical-align:bottom;'>".$enchant_levels[$ind]."</td></tr>";
	}
	echo "</table>";

}
?>