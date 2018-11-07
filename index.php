</!DOCTYPE html>
<html lang="en">
<head>
  <title>HW4</title>
  <meta name="viewpoint" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>




<?php

$user = 'root';
$password = 'root';
$db = 'hw4';
$host = 'localhost';
$port = 3306;

$conn = mysqli_connect(
   $host, 
   $user, 
   $password,
   $db,
   $port
);

  if (!$conn ) {
      die('Could not connect: ' . mysqli_error());
  }
  

  $url=$_SERVER['REQUEST_URI'] ;
  $parts=explode('/',$url);
  $endpoint=$parts[count($parts)-1];

  if(is_numeric($endpoint) && preg_match('/\d+/', $endpoint))
 {
  $id=intval($endpoint);
  
  $sql= "SELECT book.Title, book.Year, book.Year, book.Price, book.Category , GROUP_CONCAT(authors.Author_Name) AS Authors FROM book,book_authors,authors WHERE book.Book_id= '$id' && book.Book_id=book_authors.Book_id  && book_authors.Author_id=authors.Author_id GROUP BY book.Book_id";

      $retval = mysqli_query( $conn, $sql );
  $data=array();
  if(! $retval ) {
    die('Could not get data');
  }
  if (mysqli_num_rows($retval)==0) {
      echo "<br>No Data found <br>";
      
    } else {
      while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        array_push($data, $row);

      }
      echo json_encode($data);
    }
 
}

else if($endpoint== 'books')
{
    $sql= "SELECT * FROM book";
    $retval = mysqli_query( $conn, $sql );
  $data=array();
  if(! $retval ) {
    die('Could not get data');
  }
  if (mysqli_num_rows($retval)==0) {
      echo "<br>No Data found <br>";
      
    } else {
      while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        array_push($data, $row);

      }
      echo json_encode($data);
    }
}



?>


</body>
</html>