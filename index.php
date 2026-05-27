<?php include("config/db.php"); ?>
<?php include("config/env.php"); ?>
<?php include("includes/header.php"); ?>
<?php

// Database configuration
$dbhost = "dpg-d8bc526gvqtc73afk7fg-a.oregon-postgres.render.com";
$dbname = "recipe_book_91m6";
$dbuser = "recipe_book_91m6_user";
$dbpass = "iE06NhBmqIcVIbAZBgrJvLWmT34UhCb3";
$dbport = "5432";

try {

    // PostgreSQL PDO connection
    $conn = new PDO(
        "pgsql:host=$dbhost;port=$dbport;dbname=$dbname",
        $dbuser,
        $dbpass
    );

    // Enable error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully";

} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());

}

?>

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
