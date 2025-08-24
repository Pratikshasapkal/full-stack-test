<?php
require __DIR__ . '/../../src/lib/Database.php';

$pdo = Database::connect();
$stmt = $pdo->query("
    SELECT slides.*, tabs.name AS tab_name 
    FROM slides 
    JOIN tabs ON slides.tab_id = tabs.id 
    ORDER BY slides.id ASC
");
$slides = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Slides Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2 class="mb-4">Slides</h2>
    <a href="create.php" class="btn btn-primary mb-3">+ Add Slide</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tab</th>
                <th>Title</th>
                <th>Description</th>
                <th>Sort Order</th>
                <th>Active?</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($slides as $slide): ?>
                <tr>
                    <td><?= $slide['id'] ?></td>
                    <td><?= htmlspecialchars($slide['tab_name']) ?></td>
                    <td><?= htmlspecialchars($slide['title']) ?></td>
                    <td><?= htmlspecialchars($slide['description']) ?></td>
                    <td><?= $slide['sort_order'] ?></td>
                    <td><?= $slide['is_active'] ? 'Yes' : 'No' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>
