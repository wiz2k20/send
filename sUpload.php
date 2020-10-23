<?php

/*

$allowed = ["xml", "zip", "7z", "mp3", "jpg", "jpeg", "gif", "png" ];

*/

//$x_date1 = $_POST['x_date1'];
//$x_dateF = $_POST['x_dateF'];
//$ipy1 = $_POST['ipy1'];

$ipy1 = $_SERVER['REMOTE_ADDR'];

date_default_timezone_set("America/Sao_Paulo");
$x_date1=date("Y-m-d H:i:s");
$x_dateF=date("Y-m-d_H-i-s");

// Check if the form was submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
               
        $allowed = array('zip', '7z', 'rar', 'mp3', 'xml', 'docx', 'jpg', 'png', 'jpeg', 'gif'); 
        
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];                                
        
        $FNameClean1 = str_replace(' ', '-', $filename);
        $FNameClean2 = preg_replace('/[^A-Za-z0-9\-\.\_]/', '', $FNameClean1);
        $FNameClean3 = preg_replace('/-+/', '-', $FNameClean2);
        
        //$FNameClean4 = $x_dateF . "_" . $FNameClean3;
        
        // Verify file extension
        $ext = pathinfo($FNameClean3, PATHINFO_EXTENSION);
        
        //if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");                       
    
        // Verify file size
        //$maxsize = 32 * 1024 * 1024;
        $maxsize = 30 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
    
        // Verify MYME type of the file
        //if(in_array($filetype, $allowed)){
        if(in_array($ext, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("files/" . $FNameClean3)){
                echo $FNameClean3 . " is already exists.";
            } else{
                $filesizeR = $filesize/1000;
                move_uploaded_file($_FILES["photo"]["tmp_name"], "files/" . $FNameClean3);
                 
                echo "<textoDados>";
                echo "Date: " . $x_date1 . "<br>";                
                echo "Name: " . $FNameClean3 . "<br>";                              
                echo "Size: " . $filesizeR . " bytes<br>";                                                              
                echo "Type: " . $filetype . "<br>";  
                echo "Ext: " . $ext . "<br>";  
                echo "</textoDados>";
                echo "<br><textoRes>[[ Your file was uploaded successfully ]]</textoRes>";                                               
                
                include 'db1.php';
                $sql = "INSERT INTO filesend (date,name,size,type,ip) VALUES ('$x_date1', '$FNameClean3','$filesizeR','$filetype', '$ipy1')";                
                if ($cone->query($sql) === TRUE) {
                    echo "<br><br><textoRes>[[ Dados gravados no SQL ]]</textoRes>";
                } else {
                    echo "<textoerro>[ Error 22: " . $sql . " ]</textoerro>" . $cone->error;
                }
                $cone->close();                                              
            } 
        } else{
            echo "<textoerro>[ Error: There was a problem uploading your file. Please try again. ]</textoerro>"; 
        }
    } else{
        echo "<textoerro>[ Error: " . $_FILES["photo"]["error"] . " ]</textoerro>";
    }
}

/*

CREATE TABLE `filesend` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `date` datetime NOT NULL,
    `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
    `size` float NOT NULL,
    `type` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
    `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

*/

?>