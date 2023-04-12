<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connecting PHP to HTML</title>
</head>
<body>
    <?php
    $con = mysqli_connect("localhost","root","");
	if(mysqli_connect_errno()){
        print("Failed to connect to the DB : ".mysqli_connect_error());
        exit();
    }
    else
        print("Connection to MySQL Database successful!");
    
	mysqli_select_db($con,"FEEDBACK");
    $name = $_POST["username"];
    $email = $_POST["usermail"];
    $visit = $_POST["hdvisit"];
    $exp = $_POST["travelexp"];
    $useful = $_POST["webhelp"];
    $msg = $_POST["usermessage"];
    $rating = $_POST["rating"];
    $query = "INSERT INTO FORM VALUES('$name','$email','$visit','$exp','$useful','$msg','$rating')";
    $result = mysqli_query($con,$query);
    $query1="SELECT * FROM FORM";
    $result = mysqli_query($con,$query1);
    if(mysqli_error($con)){
        print("Query could NOT be executed : ".mysqli_error($con));
		exit();
    }
    print("Dear ".$name." Your Feedback has been recorded!\n");
    $rowCount = mysqli_num_rows($result);
    $fieldCount = mysqli_num_fields($result);
    
    printf("<br>Executed the query. There are %d rows and %d fields in the result\n",$rowCount,$fieldCount);
	if($rowCount == 0){
			echo "No tuples found for your query";
			exit();	
	}
	
    for($i=0;$i<$rowCount;$i++)
    {		
			$row = mysqli_fetch_array($result);
			echo $row[0]." ";
			echo $row[1]." ";
			echo $row[2]." ";
		    echo "<br>";
    }
    mysqli_close($con);
    ?>
</body>
</html>