<?php
 		$html = '<h1>I am Test</h1>';

    	include("../mpdf/mpdf.php");

		  $mpdf=new mPDF(); 

		  //$mpdf->SetDisplayMode('fullpage');

		  //$stylesheet = file_get_contents('print.css');
		
		 // $mpdf->WriteHTML($stylesheet,1);

		  $mpdf->WriteHTML($html);

		  $mpdf->Output();

		   exit;



    ?>	

   

			

