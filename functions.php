<?php
$conn = mysqli_connect("localhost", "root", "", "db_article");

function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function addArticle($data) {
  global $conn;
  $author = $data["author"];
  $date = $data["date"];
  $title = $data["title"];
  $content = $data["content"];

  $image = upload();
  if(!$image) {
    return false;
  }

  $query = "INSERT INTO article VALUES
  ('', '$image', '$title', '$author', '$date', '$content')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function createArticle() {
  $fileid = query("SELECT * FROM article ORDER BY id DESC LIMIT 1;");
  foreach ($fileid as $fid) {
    $articleId = $fid["id"];
  } 

  // Specify the name of the file to create
  $filename = './articles/article';
  $filename .= $articleId;
  $filename .= ".php";

  // Create a file handle
  $file = fopen($filename, 'w');

  // Write data to the file

  fwrite($file, 
  "<!DOCTYPE html>
  <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Document</title>
    </head>
    <body>
      <h1>Hello World</h1>
    </body>
  </html>");

  // Close the file handle
  fclose($file);

  return true;
}

function upload() {
  $fileName = $_FILES['image']['name'];
  $fileSize = $_FILES['image']['size'];
  $error = $_FILES['image']['error'];
  $tmpName = $_FILES['image']['tmp_name'];

  // cek apakah tida ada gambar yang diupload
  if($error === 4) {
    echo "
    <script>
      alert('pilih gambar terlebih dahulu');
    </script>";
    return false;
  }

  // apakah yang diupload adalah gambar
  $validImageEkstension = ['jpg', 'jpeg', 'png'];
  $imageEkstension = explode('.', $fileName);
  $imageEkstension = strtolower(end($imageEkstension));
  if(!in_array($imageEkstension, $validImageEkstension )) {
    echo "
    <script>
      alert('yang anda upload bukan gambar');
    </script>";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if($fileSize > 1000000) {
    echo "
    <script>
      alert('ukuran gambar terlalu besar');
    </script>";
    return false;
  }

  // lolos pengecekan, foto siap diupload
  // generate nama foto baru
  $newFileName = uniqid();
  $newFileName .= '.';
  $newFileName .= $imageEkstension;

  move_uploaded_file($tmpName, 'img/' . $newFileName);

  return $newFileName;

}