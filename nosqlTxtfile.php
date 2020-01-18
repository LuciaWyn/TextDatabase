<?php
$customers = file_get_contents('customers.txt');
$customers = explode("\r\n", $customers);
$kstop = 0;
$keys= array();
$results = array();
foreach ($customers as $customer){
	//gets the keys
	if ($kstop == 0){
		$locks = explode(", ", $customer);
		foreach ($locks as $lock){
			array_push($keys, $lock);
		}
		$kstop++;
	}
	else{
		$customer = explode(", ", $customer);
		$counter = 0;
		$keysLen = count($keys);
		foreach ($customer as $detail){
			//array_push($results, $detail); 
			$results[($kstop-1)][$keys[$counter]] = $detail;
			if ($keysLen != $counter){
				$counter++;
			}
			else{
				$counter = 0;
			}
		}
		$kstop++;
	}
	
}
//displays array
echo '<h2>Full Array</h2>';
print_r($results);
echo '<h2>Displayed in a Table</h2>';
//shows data as would be shown in a table format
echo "<table>";
echo "<tr>";
foreach ($keys as $key){
	echo '<th>'.$key.'</th>';
}
echo "</tr>";
foreach($results as $result){
	echo '<tr>';
	foreach($result as $r=>$customer){
			echo '<td>'.$customer.'</td>';
	}
	echo '</tr>';
}
echo '</table>';

echo '<h2>Displayed in Paragraphs</h2>';
//shows array as would appear in website form.
foreach($results as $result){
	foreach($result as $r=>$customer){
			echo '<p>'.$r.': '.$customer.'</p>';
	}
}
?>