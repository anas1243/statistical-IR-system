<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
	


	$error=$test=''; $hellyeah= array();
	
if(isset($_POST["generate"])) {

//generating the 1st file 	
$myfile1 = fopen("rand1.txt", "w") or die("Unable to open file!");
$txt = randstr( rand(4, 10) );
fwrite($myfile1, $txt);
fclose($myfile1);

//generating the 2nd file 	
$myfile2 = fopen("rand2.txt", "w") or die("Unable to open file!");
$txt = randstr( rand(4, 10) );
fwrite($myfile2, $txt);
fclose($myfile2);

//generating the 3rd file 	
$myfile3 = fopen("rand3.txt", "w") or die("Unable to open file!");
$txt = randstr( rand(4, 10) );
fwrite($myfile3, $txt);
fclose($myfile3);

//$test=randstr(5);

}else{
	//if search button is clicked 
$searchbox = test_input($_POST['x']);


if (empty($searchbox)) {
//if the search box is empty print error !
    $error = "please enter a keyword and prob. to search!";
  }
  else{
//check if the query is well formated or not 

  if(!preg_match("/^<([A-Ea-e](:(0|1|0.[0-9]{1,}|1.[0]{1,}))?;){1,}>$/",$searchbox)){
//if not !
  $error = "wrong format for searching \n
	try this: <'letter':'prob';>  
  ";
  
  }
  else{
//if the query is well formated 
  	
//remove the < > from the query to make actions then remove the space resulting from the replacement
	$searchbox = preg_replace("(<|>)"," " , $searchbox);
	$searchbox = trim($searchbox);
	
	 // put every input section in an array index to make calculations
	 //explode with ;makes every letter with its prob. in a separate index
  	$ray =  explode(';',$searchbox);
  	print_r($ray);
  	$ray1 = array();
  	
  	//put the each letter in an array followed by this value if it was given !
  	for($i=0;$i<sizeof($ray)-1;$i++) 
  	$ray1 =	array_merge($ray1,explode(':',$ray[$i]));
  	
  		/////////echo $i;
  		print_r($ray1); 
  		
  		//handle the query by setting value of char equal to its value
  		
  		 
  		$i=0;
  		$QA=0 ; $QB=0 ; $QC =0; $QD =0; $QE =0; $QAp =0; $QBp =0; $QCp =0; $QDp =0; $QEp = 0;
	for($i=0;$i<sizeof($ray1);$i++) {
		
		// note that the last index can't access the following one after it so we made 2 nested if statement
		if( (!is_numeric($ray1[$i]) ) && ($i != sizeof($ray1)-1 ) ) {
			
		if( ($ray1[$i]== 'A' || $ray1[$i]== 'a') && (is_numeric($ray1[$i+1]) ) ) {
			$QA = $i;
			$QAp	= $ray1[$i+1];
		}else if( ($ray1[$i]== 'A' || $ray1[$i]== 'a') && (!is_numeric($ray1[$i+1]) ) ) {
			$QA = $i;
			$QAp	= 1;
		}else 
		
		if( ($ray1[$i]== 'B' || $ray1[$i]== 'b') && (is_numeric($ray1[$i+1]) ) ) {
			$QB = $i;
			$QBp	= $ray1[$i+1];
		}else if( ($ray1[$i]== 'B' || $ray1[$i]== 'b') && (!is_numeric($ray1[$i+1]) ) ) {
			$QB = $i;
			$QBp	= 1;
		}else
		
		if( ($ray1[$i]== 'C' || $ray1[$i]== 'c') && (is_numeric($ray1[$i+1]) ) ) {
			$QC = $i;
			$QCp	= $ray1[$i+1];
		}else if( ($ray1[$i]== 'C' || $ray1[$i]== 'c') && (!is_numeric($ray1[$i+1]) ) ) {
			$QC = $i;
			$QCp	= 1;
		}else
		
		if( ($ray1[$i]== 'D' || $ray1[$i]== 'd') && (is_numeric($ray1[$i+1]) ) ) {
			$QD = $i;
			$QDp	= $ray1[$i+1];
		}else if( ($ray1[$i]== 'D' || $ray1[$i]== 'd') && (!is_numeric($ray1[$i+1]) ) ) {
			$QD = $i;
			$QDp	= 1;
		}else
		
		if( ($ray1[$i]== 'E' || $ray1[$i]== 'e') && (is_numeric($ray1[$i+1]) ) ) {
			$QE = $i;
			$QEp	= $ray1[$i+1];
		}else if( ($ray1[$i]== 'E' || $ray1[$i]== 'e') && (!is_numeric($ray1[$i+1]) ) ) {
			$QE = $i;
			$QEp	= 1;
		}

} else if( (!is_numeric($ray1[$i]) ) && ($i == sizeof($ray1)-1 ) ) {
		
		if( ($ray1[$i]== 'A' || $ray1[$i]== 'a')  ) {
			$QA = $i;
			$QAp	= 1;
		}else if( ($ray1[$i]== 'B' || $ray1[$i]== 'b')  ) {
			$QB = $i;
			$QBp	= 1;
		}else if( ($ray1[$i]== 'C' || $ray1[$i]== 'c')  ) {
			$QC = $i;
			$QCp	= 1;
		}else if( ($ray1[$i]== 'D' || $ray1[$i]== 'd')  ) {
			$QD = $i;
			$QDp	= 1;
		}else if( ($ray1[$i]== 'E' || $ray1[$i]== 'e')  ) {
			$QE = $i;
			$QEp	= 1;
		}
}
	}  		
  		////////echo $QAp.'  '.$QBp.'  '.$QCp.'  '.$QDp.'  '.$QEp.'<br>' ;
  		
  		
  		
  		//to know number of txt files in the IR directory to loop through them 
  		//and to make a associative array FILENAME => 0 at the beginning
  		 $counter = 0; $result=array();
  		 //this if loops through all txt files in the directory
  		if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt')
        {
        		$result = array_merge($result,array($file => 0) );
            $counter++;
        }
    }
    closedir($handle);
}
///////////echo $counter.' files<br>';
///////////echo "\n";
  		
  			///////print_r($result);
	//calculate the score of each file 	
	  		
	  		
  		 $i = 0; 
  		$A = array_pad($A,$counter,0);$B = array_pad($B,$counter,0);$C = array_pad($C,$counter,0);$D = array_pad($D,$counter,0);
  		$E = array_pad($E,$counter,0);
  		//now we need to loop through every txt file in the dir. the calculate
  		//prob. of each occurrence and the score of each file
  		if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle)))
    {
        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'txt')
        {
           
            
            $myfile = fopen("$file", "r") or die("Unable to open file!");

		$A[$i]=0 ; $B[$i]=0 ; $C[$i]=0 ;$D[$i]=0 ;$E[$i]=0 ; $rank[$i]=0; $score[$i]=0;
		
		while(!feof($myfile)) {
			
	
switch(fgetc($myfile)) {

			case A : case a: $A[$i]++; break;
			case B : case b: $B[$i]++; break;
			case C : case c: $C[$i]++; break;
			case D : case D: $D[$i]++; break;
			case E : case e: $E[$i]++; break;
				}
			}
			$rank[$i] = $A[$i] + $B[$i] + $C[$i]+ $D[$i] + $E[$i];
			$A[$i] /= $rank[$i]; $B[$i] /= $rank[$i]; $C[$i] /= $rank[$i]; $D[$i] /= $rank[$i]; $E[$i] /= $rank[$i];
			
			$score[$i]= ($A[$i] * $QAp ) +($B[$i] * $QBp ) +($C[$i] * $QCp ) +($D[$i] * $QDp ) +($E[$i] * $QEp ) ;
		
			$result[$file] = $score[$i] ; 
			
			//////echo $file;
			
			///////echo $A[$i].'  '.$B[$i].'  '.$C[$i].'  '.$D[$i].'  '.$E[$i]; echo '<br><br>';
		//////////////	echo $score[$i].'<br>';
			
fclose($myfile);
            $i++;
        }
    }
    closedir($handle);
}		
		arsort($result);
		
  		print_r($result);
  		$thelist = '';
  		foreach($result as $key => $value) {
 		
 		$thelist .= '<li><a href="'.$key.'">'.$key.'</a></li>';   
	
}	$hellyeah = $thelist;
	//echo($hellyeah);
  
		}
		}
	
	}	
  
}




function test_input($data) {
  $data = trim($data);
 //$data = stripslashes($data);
  //$data = htmlspecialchars($data);
  return $data;
} 

//function to generate a random string 
function randstr($length = 10) {
    $characters = 'ABCDE';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

















?>