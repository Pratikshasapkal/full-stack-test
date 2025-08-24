<?php
require __DIR__ . '/../../src/lib/Database.php';

$pdo = Database::connect();

// fetch tabs for dropdown
$tabs = $pdo->query("SELECT * FROM tabs WHERE is_active = 1 ORDER BY sort_order ASC")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tab_id = (int) $_POST['tab_id'];
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $sort_order = (int) ($_POST['sort_order'] ?? 0);
    $is_active = isset($_POST['is_active']) ? 1 : 0;

    $stmt = $pdo->prepare("INSERT INTO slides (tab_id, title, description, sort_order, is_active) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$tab_id, $title, $description, $sort_order, $is_active]);

    header("Location: list.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Slide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">

    <h2 class="mb-4">Add New Slide</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Tab</label>
            <select name="tab_id" class="form-select" required>
                <option value="">-- Select Tab --</option>
                <?php foreach ($tabs as $tab): ?>
                    <option value="<?= $tab['id'] ?>"><?= htmlspecialchars($tab['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="form-control" value="0">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="list.php" class="btn btn-secondary">Cancel</a>
    </form>

</body>
</html>
