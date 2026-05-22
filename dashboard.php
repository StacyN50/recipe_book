<?php
include("config/db.php");
include("includes/header.php");

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM recipes WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<div class="dashboard">

<h1>My Recipes</h1>

<div class="recipes-grid">

<?php while($row = $result->fetch_assoc()): ?>

<div class="recipe-card">

<img src="assets/uploads/<?php echo $row['image']; ?>">

<div class="recipe-content">

<h3><?php echo $row['title']; ?></h3>

<a href="recipe.php?id=<?php echo $row['id']; ?>">View</a>

<a href="edit_recipe.php?id=<?php echo $row['id']; ?>">Edit</a>

<a href="delete_recipe.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete Recipe?')">
Delete
</a>

</div>

</div>

<?php endwhile; ?>

</div>

</div>

<?php include("includes/footer.php"); ?>