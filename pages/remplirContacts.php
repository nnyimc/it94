<?php
  $co = mysqli_connect("localhost","root","Feel2019","it94");
 
  function remplirContacts(){
	  if(isset($_POST['submit'])){
		  $colonnes ='';
		  $valeurs ='';
		  $tabChamp = $_POST;
		  $co = mysqli_connect("localhost","root","Feel2019","it94");
		    foreach($tabChamp as $index=>$valeur){
				if($index != 'submit' && $index != 'message'){
				$colonnes .= $index . " , ";
				} else if ($index != 'submit' && $index == 'message'){
			    $colonnes .= $index;
				} 
			}
			
			foreach($tabChamp as $index=>$valeur){
				if($index != 'submit' && $index != 'message'){
				  $valeurs .= "'" . htmlspecialchars($valeur) . "' , ";
				} else if ($index != 'submit' && $index == 'message'){
			      $valeurs .= "'" . htmlspecialchars(mysqli_real_escape_string($co, $valeur)) . "'";
				} 
			}
			
			$sql2 = "INSERT INTO infosContacts (" . $colonnes .") VALUES (" . $valeurs . ");";
			mysqli_query($co, $sql2) or 
			  die ("Insertion impossible" . mysqli_error($co));
			
		}
  }
  mysqli_close($co);
?>