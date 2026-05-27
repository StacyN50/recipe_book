<?php include("config/db.php"); ?>
<?php include("config/env.php"); ?>
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

$where = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $where = "WHERE title LIKE '%$search%'";
}

$sql = "SELECT * FROM recipes $where ORDER BY id DESC";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()):
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

<?php endwhile; ?>

</div>

<?php include("includes/footer.php"); ?>
