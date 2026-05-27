<?php include("config/db.php"); ?>

<?php include("includes/header.php"); ?>

<div class="hero">
    <h1>Discover Amazing Recipes</h1>

    <form method="GET">
        <input type="text" name="search" placeholder="Search recipes...">
        <button>Search</button>
    </form>
</div>

<div class="recipes-grid">

<?php
$stmt = $conn->prepare($sql);
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($recipes as $row):
?>

<div class="recipe-card">

    <img src="assets/uploads/<?php echo $row['image']; ?>">

    <div class="recipe-content">
        <h3><?php echo $row['title']; ?></h3>
        <p><?php echo $row['category']; ?></p>

        <a href="recipe.php?id=<?php echo $row['id']; ?>">
            View Recipe
        </a>
    </div>

</div>

<?php endforeach; ?>

</div>

<?php include("includes/footer.php"); ?>
