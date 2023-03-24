<?php
  require "functions.php";
  if(isset($_POST["submit"])) {
    if(addArticle($_POST) > 0  ) {
      createArticle();
      echo "
        <script>
          alert('data berhasil ditambahkan');
          // 
        </script>
      ";
    } else {
      echo "
      <script>
        alert('data gagal ditambahkan');
        document.location.href = 'index.php'
      </script>
    ";
    }
  };
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anta CMS | add article</title>
</head>
<body>
  <h1>Add New Article</h1>
  <form action="" method="post">
    <div class="data">
      <label for="author">Author</label>
      <input type="text" name="author" id="author">
    </div>
    <div class="data">
      <label for="title">Title</label>
      <input type="text" name="title" id="title">
    </div>
    <div class="data">
      <label for="content">Content</label>
      <textarea name="content" id="content"></textarea>
    </div>
    <div class="data">
      <label for="image">Image</label>
      <input type="file" name="image" id="image">
    </div>
    <div class="data">
      <label for="date">Date Published</label>
      <input type="date" name="date" id="date">
    </div>
    <div class="data">
      <button type="submit" name="submit">Publish</button>
    </div>
  </form>
</body>
</html>