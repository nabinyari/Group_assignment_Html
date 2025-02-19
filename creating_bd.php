<?php
// Creating database
$servername = "localhost"; 
$username = "root";
$password = ""; 


$conn = mysqli_connect($servername, $username, $password);
$sql ="CREATE DATABASE nabin";
$result = mysqli_query($conn, $sql);
if($result)
{
    echo "Created successfully";
    $sql2 = "USE nabin";
    $result2 = mysqli_query($conn, $sql2);
        if($result2)
            {
                echo "Created successfully";
                $sql3 = "CREATE TABLE users (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        email VARCHAR(255) NOT NULL UNIQUE,
                        password VARCHAR(255) NOT NULL)";
                $result3 = mysqli_query($conn, $sql3);
                if($result)
                    {
                        echo "Created successfully";
                    }
                    else
                    {
                        die("Filed to create ". mysqli_error($conn));
                    }
                $sql4 = "CREATE TABLE gift_card (
                        id INT NOT NULL AUTO_INCREMENT,
                        email_id VARCHAR(50) NOT NULL,
                        amount DECIMAL(10,2) NOT NULL DEFAULT 50.00,
                        purchase_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (id),
                        FOREIGN KEY (email_id) REFERENCES users(email) )";
                $result4 = mysqli_query($conn, $sql4);
                    if($result)
                    {
                        echo "Created successfully";
                    }
                    else
                    {
                        die("Filed to create ". mysqli_error($conn));
                    }
            }
            else
            {
                die("Filed to create ". mysqli_error($conn));
            }
}
else
{
    die("Filed to create ". mysqli_error($conn));
}
?>