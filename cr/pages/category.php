<?php
// Created by CarcaBot
// 25.09.2013
// CarcaBot@CarcaBot.ro

require_once("..//SMS_Module/classes/mysqli.php");
require_once("..//SMS_Module/classes/sql.class.php");


?>
        <strong>Our menu categories</strong>

        <table class="table3" width="99%">
            <tr>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>
                </thead>
                <tbody>
                    </tbody></tr>
<?php
$i=1;
foreach(categoryList() as $category) {

echo '<tr>
	<td>'.$i.'.</td>
	<td>'.$category['name'].'</td>
	<td>'.$category['note'].'</td>	
      </tr>
 
';
$i++;
}

?>
           
        </table>
       
        <div class="divider"></div>
        
        <a href="#">Back</a>
        
    
