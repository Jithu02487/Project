<?php 
	    	        // Connect to the database
			$conn = new mysqli("localhost", "dbUser", "dbPassword", "forward_linkage");

			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}
?>
