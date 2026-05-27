<?php
include("config/db.php");
include("includes/header.php");

// Get search input
$search = $_GET['search'] ?? "";

// Build query safely
if ($search !== "") {

    $sql = "SELECT * FROM recipes WHERE title ILIKE :search ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ":search" => "%$search%"
    ]);

} else {

    $sql = "SELECT * FROM recipes ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="hero">
    <h1>Discover Amazing Recipes</h1>

    <form method="GET">
        <input type="text" name="search" placeholder="Search recipes...">
        <button>Search</button>
    </form>
</div>

<div class="recipes-grid">

<?php foreach ($recipes as $row): ?>

    <div class="recipe-card">

        <img src="assets/uploads/<?php echo htmlspecialchars($row['image']); ?>">

        <div class="recipe-content">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><?php echo htmlspecialchars($row['category']); ?></p>

            <a href="recipe.php?id=<?php echo $row['id']; ?>">
                View Recipe
            </a>
        </div>

    </div>

<?php endforeach; ?>

</div>

<?php include("includes/footer.php"); ?>
