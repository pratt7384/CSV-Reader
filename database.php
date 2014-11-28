<html>
  <head> 
  <title>Save Excel file details to the database</title>
  </head>
  <body>
	<?php
		$conn = mysql_connect('localhost','root','') or die(mysql_error());
		mysql_select_db('csv',$conn) or die(mysql_error());
		include 'reader.php';
    	$excel = new Spreadsheet_Excel_Reader();
	?>
	    <table border="1">
		<?php
			if($_POST['submit'])
			{
				$name=time().$_FILES["file"]["name"];
				$tmp_name = $_FILES["file"]["tmp_name"];
				move_uploaded_file($tmp_name, "upload/".$name);
			
			
            $excel->read('upload/'.$name);    
			$x=2;
			while($x<=$excel->sheets[0]['numRows']) {
				$primarytop = isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
				$topic = isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
				$personal = isset($excel->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
				$image = isset($excel->sheets[0]['cells'][$x][4]) ? $excel->sheets[0]['cells'][$x][4] : '';
				$name = isset($excel->sheets[0]['cells'][$x][5]) ? $excel->sheets[0]['cells'][$x][5] : '';
				$ari = isset($excel->sheets[0]['cells'][$x][6]) ? $excel->sheets[0]['cells'][$x][6] : '';
				$peter = isset($excel->sheets[0]['cells'][$x][7]) ? $excel->sheets[0]['cells'][$x][7] : '';
				$proority = isset($excel->sheets[0]['cells'][$x][8]) ? $excel->sheets[0]['cells'][$x][8] : '';
				$assign = isset($excel->sheets[0]['cells'][$x][9]) ? $excel->sheets[0]['cells'][$x][9] : '';
				$note = isset($excel->sheets[0]['cells'][$x][10]) ? $excel->sheets[0]['cells'][$x][10] : '';
				 $we = isset($excel->sheets[0]['cells'][$x][11]) ? $excel->sheets[0]['cells'][$x][11] : '';
				$note= addslashes($note);
				// Save details
				$sql_insert="INSERT INTO csv_data (id,primarytop,topic,personal,name,image,ari,peter,proority,assign,we,note) 
				VALUES ('','$primarytop','$topic','$personal','$name','$image','$ari','$peter','$proority','$assign','$we','$note')";
				$result_insert = mysql_query($sql_insert) or die(mysql_error()); 
				 
			  $x++;
			}
			}
        ?>    
    </table>
    <form action="" method="POST" enctype="multipart/form-data">
		<input type="file" name="file">
    <input type="submit" name="submit">
    </form>

  </body>
</html>
