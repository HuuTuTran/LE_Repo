<?php
    echo "<form action='/ImgStorage/Index.php?act=updateProcess' enctype='multipart/form-data' method='post'>";
    echo "<input hidden type='text' name='id' value='".$i->id."'/></br>";
    echo "Title:<input type='text' name='title' value='".$i->title."'/></br>";
    echo "description:<input type='text' name='description' value='".$i->description."'/></br>";
    echo "Image:";
    echo "<img style='height:100px;width:100px' src='".$i->thumb."' /></br>";
    echo "<input type='text' hidden name='thumb' value='".$i->thumb."'/></br>";
    echo "<input type='file'  name='fileToUpload'/></br>";

    echo "Status:";
    if ($i->status ==1 ){      
        echo "<select name='status'>";
            echo "<td> <option value='1' selected='selected'>Enabled";
            echo "</option> </td>";
            echo "<td> <option value='0'>Disabled";
            echo "</option> </td>";
        echo "<select/>";
    }else{
        echo "<select name='status'>";
            echo "<td> <option value='1'  >Enabled";
            echo "</option> </td>";
            echo "<td> <option value='0' selected='selected'>Disabled";
            echo "</option> </td>";
        echo "<select/>";                       
    }           
    echo "<p><button>Submit</button></p>";
    echo "</form>";
    error_reporting(E_ERROR | E_PARSE);
    echo $error ;
?>
  