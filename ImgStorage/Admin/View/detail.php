<?php session_unset();?>
<!DOCTYPE html>
<html>
<head>
	<title>Image</title>
	<style type="text/css">
		table, th, td {
		  border: 1px solid black;
		}
		table {
		  width: 100%;
		}
	</style>
</head>
<body>
    <?php
        if($result->num_rows > 0){
            echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>title</th>";
                        echo "<th>thumb</th>";
                        echo "<th>description</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
            	while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td> <img style ='width:30px;height:30px' src='". $row['thumb']."'/></td>";
                        echo "<td>" . $row['description'] . "</td>";

                	echo "</tr>";		  		
                }
                // while($row = mysqli_fetch_array($result)){

                // }
                echo "</tbody>";                            
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
        } else{
            echo "<p class='lead'><em>No records were found.</em></p>";
        }
    ?>
</body>
</html>