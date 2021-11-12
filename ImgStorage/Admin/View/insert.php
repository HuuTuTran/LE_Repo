<form action='/ImgStorage/Index.php?act=insert' enctype='multipart/form-data' method='post' >
    Title:<input value='' type='text' name='title'></br>
    Thumb:<input type='file' name="fileToUpload"></br>
    description<input type='text' name='description'></br>
   <input type="submit" value="Process" name="submit"></form>
<?php
	error_reporting(E_ERROR | E_PARSE);
	echo $error ;
?>