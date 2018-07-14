<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        $filename = 'newfile.php';
        if(!file_exists($filename)){
            $myfile = fopen($filename, "w") or die("Unable to open file!");
            $txt1 = "John Doe\n";
            fwrite($myfile, $txt1);
            $txt2 = "Jane Doe\n";
            fwrite($myfile, $txt2);
            fclose($myfile);
            echo "New File has been created.<br/>";
        }
        else{
            
            $myfile = fopen($filename, "r") or die("Unable to read file!");
           echo fread($myfile, filesize($filename) );
            fclose($myfile);
        }
           // File has been Created
            
          echo  file_exists('../../'.'index.php');
               
           
            
        ?>
    </body>
</html>
