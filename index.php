<?php
    $myFile = fopen("admin/news.json", "r");
    $filesize = filesize("admin/news.json");
    if ($filesize > 0) {
        $newsData = json_decode(fread($myFile, $filesize), true);
    }

    usort($newsData, function ($a, $b) {
        // ví dụ: 19/10/2025 -> 19-10-2025
        $timeA = strtotime(str_replace('/', '-', $a['date']));
        $timeB = strtotime(str_replace('/', '-', $b['date']));
        return $timeB - $timeA; // sắp xếp giảm dần
    });
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <?php include 'inc/style.php' ?>
    <style>
        .news-card img {
            width: 100%;
            height: auto;
            object-fit: contain;
            background-color: #f8f9fa;
        }

        .news-card {
            transition: transform 0.2s ease;
        }

        .news-card:hover {
            cursor: pointer;
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <?php include 'inc/client/menu.php' ?>
    <div class="container my-4">
        <div class="p-4 bg-success text-white rounded text-center mb-4">
            <h1 class="mb-0">Tin tức mới nhất</h1>
            <p class="mb-0">Cập nhật các bài viết mới và nổi bật nhất</p>
        </div>

        <div class="row">
            <?php if (!empty($newsData)): ?>
                <?php foreach ($newsData as $news): ?>
                    <div class="col-md-4 mb-4">
                        <a href="news-detail.php?id=<?= $news['id'] ?>" class="text-decoration-none text-dark">
                            <div class="card news-card shadow-sm h-100">
                                <img src="<?= 'admin/' . $news['image'] ?>" class="card-img-top" alt="<?= $news['title'] ?>">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= $news['title'] ?></h5>
                                    <p class="card-text text-muted small mb-1">
                                        <?= $news['category'] ?> | <?= $news['author'] ?>
                                    </p>
                                    <p class="text-end text-secondary small mb-0 mt-auto"><?= $news['date'] ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center text-muted py-5">
                    <p>Hiện chưa có bài viết nào.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>