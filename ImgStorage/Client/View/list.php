<?php
    session_start();
?>
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
        .pagination {
          display: inline-block;
        }

        .pagination a {
          color: black;
          float: left;
          padding: 8px 16px;
          text-decoration: none;
        }

        .pagination a.active {
          background-color: #4CAF50;
          color: white;
        }

    .pagination a:hover:not(.active) {background-color: #ddd;}
	</style>
</head>
<body>
    <?php
        if ($total != null){
            while($row = $total->fetch_assoc()) {
                $_SESSION["Crowcount"]= $row['COUNT(*)'];                                        
        }
    }        
        $take = 0;
        if($_SESSION["Ctake"] != null){
            $take = (int)$_SESSION["Ctake"];
        }else{
            $take=5;
        }
        if($result->num_rows > 0){
            echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>id</th>";                                        
                        echo "<th>title</th>";
                        echo "<th>thumb</th>";
                        echo "<th>Actions</th>";

                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
            	while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['title'] . "</td>";
                        echo "<td> <img style ='width:30px;height:30px' src='". $row['thumb']."'/></td>";
                        echo "<td>";
                        echo "<a href='Index.php?key=c&act=detail&id=".$row['id']."'>Detail</a>";
                        echo "</td>";
                	echo "</tr>";		  		
                }
                echo "</tbody>";                            
            echo "</table>";
                echo "<select onchange='location = this.value;'>";
                echo "  <option value='-1'>";
                echo "      pls choose a pagesize   ";
                echo "  </option>";
                echo "  <option value='Index.php?key=c&act=setLimit&take=5'>";
                echo "      5   ";
                echo "  </option>";
                echo "  <option value='Index.php?key=c&act=setLimit&take=10'>";
                echo "      10";
                echo "  </option>";
                echo "  <option value='Index.php?key=c&act=setLimit&take=50'>";
                echo "      50";
                echo "  </option>";
                echo "  <option value='Index.php?key=c&act=getall'>";
                echo "      all";
                echo "  </option>";
                echo "</select>";
                echo "<div class='pagination'>";
                echo "<a href='Index.php?key=c&act=paginate&pagenum=1'>&laquo;</a>";
                for ($i=0; $i <ceil((int)$_SESSION["Crowcount"]/$take) ; $i++) { 
                    echo "<a href='Index.php?key=c&act=paginate&pagenum=".($i+1)."'>".($i+1)."</a>";
                }
                echo "<a href='Index.php?key=c&act=paginate&pagenum=".ceil((int)$_SESSION["Crowcount"]/$take)."'>&raquo;</a>;";
                echo "</div>";
            mysqli_free_result($result);
        } else{
            echo "<p class='lead'><em>No records were found.</em></p>";
        }
    ?>
</body>
</html>