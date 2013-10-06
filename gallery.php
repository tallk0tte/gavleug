<?php 

function getArrayFromPath($path){

	$result = array();
	$handle = opendir($path);
	while($file = readdir($handle)){
		
		if($file != "." && $file !=".."){
			$result[] = $file;
		}
	}
	closedir($handle);
	return $result;
}


function writeImagesFromArray($arrayen,$rader) {
    $size = sizeof($arrayen);
	$nr =0;
	$bild;
	while($nr < $size){	
		$bild = $arrayen[$nr];
		//if($nr == $rader  || $rader == $rader *2 || $nr == $rader *3 || $nr ==($rader*4)){echo "<tr>";}
		if($nr%$rader==0){echo "<tr>";}
		echo "<img  onclick=\"changeLink('".$bild."')\" class=\"galleryImg\" id=\"".$nr."\" width=\"110\"  height=\"110\" src=\"images/".$arrayen[$nr]." \"> ";
		//if($nr == $rader - 1 || $nr == ($rader *2) -1 || $nr == ($rader *3) -1 || $nr ==($rader *4) ){echo "</tr>";}
		$nr = $nr +1;
		if($nr%$rader==0){echo "</tr>";}	
	}
}
?>
