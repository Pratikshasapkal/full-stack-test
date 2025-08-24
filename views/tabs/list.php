<?php
require __DIR__ . '/../../src/lib/Database.php';

$pdo = Database::connect();
$stmt = $pdo->query("SELECT * FROM tabs ORDER BY sort_order ASC, id ASC");
$tabs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tabs Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2 class="mb-4">Tabs</h2>
    <a href="create.php" class="btn btn-primary mb-3">+ Add Tab</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Sort Order</th>
                <th>Active?</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tabs as $tab): ?>
                <tr>
                    <td><?= $tab['id'] ?></td>
                    <td><?= htmlspecialchars($tab['name']) ?></td>
                    <td><?= htmlspecialchars($tab['slug']) ?></td>
                    <td><?= $tab['sort_order'] ?></td>
                    <td><?= $tab['is_active'] ? 'Yes' : 'No' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
