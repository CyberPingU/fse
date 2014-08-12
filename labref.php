<?php
$data = array_map('str_getcsv', file('reflab.csv'));
$finale=array();
$righe = count($data);
$colonne = max(array_map( 'count',  $data) );
$contatore = 0;
$tradizionale = 0;
$fascicolo = 0;
$percentuale = 0;
for($i=0; $i<=$righe; $i++){
	$contatore++;
	array_push($finale, $data[$i]);
	if($data[$i][0]!=$data[$i+1][0]){
		while($contatore>=0){
			$somma=$somma + $data[$i-$contatore][2];
		if($data[$i-$contatore][3]=="Ritiro tradizionale")
			$tradizionale = $tradizionale + $data[$i-$contatore][2];
		else
			$fascicolo = $fascicolo + $data[$i-$contatore][2];
		$contatore--;
		}
		$percentuale = $fascicolo/$somma * 100;
		array_push($finale, array('*','*','*',$somma, $tradizionale, $fascicolo, $percentuale));
		$somma = 0;
		$tradizionale = 0;
		$fascicolo = 0;
	}

}
//echo "fatto";

$righe = count($finale);
$colonne = max(array_map( 'count',  $finale) );

for($i=0; $i<=$righe; $i++){
	for($j=0; $j<=$colonne; $j++){
		echo $finale[$i][$j];
		echo " ";
	}
	echo "<br>";
	}
	

$fp = fopen('file.csv', 'w');

foreach ($finale as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

?>

