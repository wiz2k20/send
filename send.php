<html>
<head>
<link rel="stylesheet" href="sty1.css">
<title>send</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="shortcut icon" href="/favicon1.ico" type="image/x-icon">
<link rel="icon" href="/favicon1.ico" type="image/x-icon">

</head>
<body oncontextmenu="return false;">

<?php
/*

<script>
function reqpass1() {
  var pswd = prompt("nb", "pp");
  //if (pswd != null) {
  if (pswd == 000000) {
    document.getElementById("yw1").innerHTML = pswd;
  }  
}
</script>

*/

?>

<div class="wrapper"> <!–– DIV WRAPPER ––>
<script src="desativar.js"></script>

<?php include 'db1.php'; ?>

<script>
function reqpass2(clicked) {
  var pswd = prompt("pass", "");
  //if (pswd != null) {
  if (pswd == 55669) {
    //document.getElementById("yw1").innerHTML = pswd;
    //document.getElementById("yw2").innerHTML = clicked;
    var clicado = clicked;
    window.location.href = "deldata.php?id=" + clicado;

    //window.location.href = "http://localhost/main.php?width=" + width + "&height=" + height;
    //echo "<td><a href='deldata.php?id=" . $row["cod"] . "'>del</a></td>";
  }  
}
</script>

<table class="Tabela_1">
  <tr>
    <th></th>
    <th></th>
  </tr>
  <tr>
    <td id='tdSEND'>
    
<?php // = = = = = TEXT AREA = = = = =
//<button class="send1" id="369" onclick="reqpass2(this.id)">del</button>
?>
<form action="" method="post">
<textoverde>To Do List:</textoverde><br><br>

<textarea cols="50" rows="1" name="com0" id="yw1" style="text-transform:uppercase"></textarea><br><br>
<textarea cols="80" rows="10" name="comments" id="yw2" wrap="hard" style="text-transform:uppercase"></textarea><br><br>

<table class="envia">
  <tr>
    <th align="center"><input type="checkbox" name="job" disabled><textoverde>job</textoverde></th>
    <th align="center"><input type="submit" class="send1" name="button" value="send"/></th>
  </tr>
</table>
</form>

<?php
$checkcc= '';
$com0= strtoupper($_POST['com0']);
$comments= strtoupper($_POST['comments']);

echo "<textobranco>TEXTO: " . $comments . "</textobranco><br><br>";
echo "<textobranco>cc: " . $checkcc . "</textobranco><br><br>";

if ($comments <> "")
{ 
$ver='1';
echo "<textobranco>ver: " . $ver . "</textobranco><br><br>";
}

if( empty($_POST["job"]) )
{
echo "<textoverde>[ Checkbox unchecked ]</textoverde><br><br>";
}
else
{
echo "<textoverde>[ Checkbox CHECKED ]</textoverde><br><br>";
$checkcc= 'suporte04@windel.com.br';
}

if ($ver == '1')
{ // = = = = = = = = = = BEFIN IF = = = = = = = = = = 

date_default_timezone_set("America/Sao_Paulo");
$date1= date("d/m/Y");
$time1= date("H:i:s");
$week1= date("l");

echo "<textobranco>Date: " . $date1 . " ( " . $week1 . " ) - " . $time1 . "</textobranco><br><br>";
/* echo "Week: " . $week1 . "<br>"; */
/* echo "Time: " . $time1 . "<br><br>"; */

//echo "Date: " . date("d/m/Y") . " (" . date("l") . ")" . "<br><br>";
//echo "Time: " . date("H:i:s");

// = = = = = INSERE NA TABELA = = = = =
$sql = "INSERT INTO tabguarda (date, time, abt19, text) VALUES ('$date1', '$time1', '$com0', '$comments')";

if ($cone->query($sql) === TRUE) {
    echo "<textoverde>[ New record created successfully ]</textoverde>" . "<br><br>";
} else {
    echo "<font color='red'>[ Error: " . $sql . " ]</font><br><br>" . $cone->error;
}

// = = = = = MAIL FUNCTION = = = = =
// $msg1 = "First line of text\nSecond line of text";
// use wordwrap() if lines are longer than 70 characters
// $msg1 = wordwrap($msg1,70);

$to1 = 'marcbrcx@gmail.com';
$about1 = '_ ' . $com0;

$head1 = [
'MIME-Version: 1.0',
'Content-Type: text/html; charset=ISO-8859-1',
'From: DATA ark1 <data@ark1.ws>',
//'Cc: playstreet2019@gmail.com'
'Cc: ' . $checkcc . ''
];
$head1 = implode("\r\n", $head1);

$msg1 = "<html><body>";
$msg1 .= "<br><br>";
$msg1 .= "<p style='font-size:20px'>about:</p>";
$msg1 .= "<p style='font-size:20px'><font color='green'>" . $com0 . "</font></p>";
$msg1 .= "<br>";
$msg1 .= "<p style='font-size:20px'>text:</p>";
$msg1 .= "<p style='font-size:20px'><font color='blue'>" . $comments . "</font></p>";
$msg1 .= "<br><br>";
$msg1 .= "</body></html>";

if(mail($to1, $about1, $msg1, $head1)){
    echo "<textoverde>[ Your mail has been sent successfully ]</textoverde><br><br>";
} else{
    echo "<font color='red'>[ Unable to send email. Please try again ]</font><br><br>";
}
// mail(to, subject, message, headers, parameters)

} // = = = = = = = = = = END IF = = = = = = = = = =
?>    
    
    </td>
    <td id='tdUPLOAD'>
    
<!-- Display upload status -->
<div id="uploadStatus" class="z"></div>

<br><br>
<!-- Progress bar -->
<div class="progress" id="z">
    <div class="progress-bar" id="z"></div>
</div>

<br>
<div class="textoSizeProgress" id="SizeProgress"></div>
<br>

<form id="form" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>       
        <input type="file" name="photo" class="bUpload" id="photo"><br>
        <br>       
        <input type="submit" name="submit" class="bUpload" id="submit" value="Upload">
        <br><br><textobranco><strong>Extension:</strong> zip, 7z, rar, mp3, xml, docx, jpg, png, jpeg, gif</textobranco>
        <br><textobranco><strong>Max size:</strong> 30 MB</textobranco>
</form>

<br>
<div class="z" id="x_resultado"></div>
<br><br>

<script>                   	
$(document).ready(function(e){		
	$("#form").on('submit', function(e){	  
				e.preventDefault(); 				
				var formData = new FormData(this);
				//formData.append('x_date1', date1);	
				//formData.append('x_dateF', dateF);			                                   
                $.ajax
                ({//ajax
                	xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = ((evt.loaded / evt.total) * 100);
                                $(".progress-bar").width(percentComplete + '%');
                                $(".progress-bar").html('<textoStatus>Status: ' + Math.round(percentComplete) + '%</textoStatus>');                               
                                $("#SizeProgress").html('<textoRes>Uploaded: ' + evt.loaded/1000 + ' bytes</textoRes><br><textoRes>Total: ' + evt.total/1000 + ' bytes</textoRes>');                              
                            }
                        }, false);
                        return xhr;
                    },                    
                	method: 'POST',
                    url:'sUpload.php',                    
                    data: formData,                                                            
                    cache: false,
                	contentType: false,
                	processData: false,
                	beforeSend: function(){
                		$('#form').css("opacity",".5");
                		$("#submit").prop('disabled', true);
                		$("#photo").prop('disabled', true);                		                                                                                            
                    },
                    error:function(){
                        $('#uploadStatus').html('<p><textoerro>File upload failed, please try again.</textoerro></p>');
                    },                                                     	
                	success: function(data)
                    {  
                	   var mostra1 = data;
                	   $('#x_resultado').html(mostra1);
                	   $('#form')[0].reset();  
                	   $('#form').css("opacity","");
                	   $("#submit").prop('disabled', false);
                	   $("#photo").prop('disabled', false);              	   
                	   //x_arquivos();
                	   //$('#x_resultado').text(mostra1);               	   
                    }               	
                });//ajax  
	});           
});                  
//}
</script>    
    
    </td>
  </tr>
</table>

<br>
<?php
// = = = = = MOSTRA DADOS TABELA = = = = =
$sql1 = "SELECT cod, date, abt19, time, text FROM tabguarda ORDER BY cod DESC";
$res1 = $cone->query($sql1);

if ($res1->num_rows > 0) {
    // output data of each row
echo "<table class='lista'>";

echo "
<thead><tr>
<th style='width:3%' id='thID'>ID
<th style='width:6%' id='thDate'>Date
<th style='width:6%' id='thTime'>Time
<th style='width:25%' id='thAbout'>About
<th style='width:57%' id='thText'>Text
<th style='width:3%' id='thDel'>del
</thead><tbody>";

//HOW SET CSS TO ONE COLUMN    

while($row = $res1->fetch_assoc())
    {          
echo "<tr><td id='tdID'>" . $row["cod"] . "</td><td id='tdDate'>" . $row["date"] . "</td><td id='tdTime'>" . $row["time"] . "</td><td id='tdAbout'>" . $row["abt19"] . "</td><td id='tdText'> " . nl2br($row["text"]) . "</td>";

echo "<td id='tdDel'><button class='send1' id=" . $row["cod"] . " onclick='reqpass2(this.id)'>del</button></td>";

//echo "<td><a href='deldata.php?id=" . $row["cod"] . "'>del</a></td>";
//echo "<td><a href='deldata.php?id=" . $row["cod"] . "' target='_blank'>del</a></td>";
echo "<td></td></tr>";  

// https://stackoverflow.com/questions/43286387/adding-a-delete-button-in-php-on-each-row-of-a-mysql-table/43286487
                                                
//echo $row["date"]. " - " . $row["time"]. " {> <font color='green'>" . $row["abt19"]. "</font> <} | {> <b><font color='blue'>" . $row["text"]. "</font></b> <}<br><br>";
    }
    echo "</tbody></table>"; 
} else {
    echo "0 results";
}
// = = = = = MOSTRA DADOS TABELA = = = = = FECHA
?>

<br>
<?php
$ver='0';
echo "<textobranco>ver: " . $ver . "</textobranco>";
echo "<br><br>";
echo "<textobranco>cc: " . $checkcc . "</textobranco>";
echo "<br><br>";
//echo '<textoverde>Marcio - 24/8/19</textoverde>';
//echo "<br><br>";
$cone->close();
?> 

<div class="push"></div>
</div> <!–– DIV WRAPPER ––>
<div class="footer">
<textoverde>by Marcio | Created on: 24/08/2019 | Last update: 03/04/2020</textoverde>
</div>
 </body>
</html>