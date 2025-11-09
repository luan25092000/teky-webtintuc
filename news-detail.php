<?php
    $id = $_GET['id'];
    $myfile = fopen("admin/news.json", "r");
    $filesize = filesize("admin/news.json");
    if ($filesize > 0) {
        $newsData = json_decode(fread($myfile, $filesize), true);
    }

    foreach ($newsData as $key => $news) {
        if ($news['id'] == $id) {
            $newsDetail = $newsData[$key];
            break;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết tin tức</title>
    <?php include 'inc/style.php' ?>
</head>

<body>
    <?php include 'inc/client/menu.php' ?>
    <div class="container my-5">
        <?php if ($newsDetail): ?>
            <h1 class="mb-3"><?= $newsDetail['title'] ?></h1>
            <p class="text-muted small mb-4">
                <?= $newsDetail['category'] ?> |
                <?= $newsDetail['author'] ?> |
                <?= $newsDetail['date'] ?>
            </p>
            <img src="<?= 'admin/' . $newsDetail['image'] ?>" class="mb-4" width="100%">
            <p><?= $newsDetail['content'] ?></p>
        <?php else: ?>
            <div class="alert alert-warning">Không tìm thấy bài viết.</div>
        <?php endif; ?>
    </div>
</body>

</html>