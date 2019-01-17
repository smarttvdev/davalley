

<?php
if(isset($_POST['audio'])){
 	$audio = base64_decode($_POST['audio']);
	 echo $audio; 
  
}

if(isset($_FILES['file'])){
  $audio = file_get_contents($_FILES['file']['tmp_name']);
  $audio1 = str_replace('data:audio/wav;base64,', '', $audio);
  $decoded = base64_decode($audio1);
  
  $file_location = "./uploads/recorded_audio.wav";
 
  file_put_contents($file_location, $audio);
  echo "success uploading! please see uploads dir!!!";
  
  
}
?>