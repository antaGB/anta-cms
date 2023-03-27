<?php
require "functions.php";

$articles = query("SELECT * FROM article");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Anta CMS</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <header>
    <h1>Welcome to Anta CMS</h1>
    <p>This is as self made content management system</p>
  </header>
  <main>
    <div class="action-container">
      <a href="./add_article.php" class="new-article">Create Article</a>
    </div>
    <div class="article-container">
      <?php foreach($articles as $article):?>
        <div class="article">
          <div class="img">
            <img src="./img/<?= $article["image"]?>" alt="">
          </div>
          <div class="text">
            <h2><?= $article["title"] ?></h2>
            <p><?= $article["content"] ?></p>
            <a href="./articles/article<?= $article['id'] ?>.php?id=<?= $article['id']?>">Read More</a>
          </div>
          <div class="action">
            <a id="delete" href="./delete.php?id=<?= $article['id'] ?>">D</a>
            <a id="edit" href="./edit.php?id=<?= $article['id'] ?>">E</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
</body>
</html>