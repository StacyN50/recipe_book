<?php
include("config/db.php");
include("includes/header.php");

$id = $_GET['id'];

$sql = "SELECT * FROM recipes WHERE id='$id'";
$result = $conn->query($sql);
$recipe = $result->fetch_assoc();
?>

<div class="recipe-details">

<img src="assets/uploads/<?php echo $recipe['image']; ?>">

<h1><?php echo $recipe['title']; ?></h1>

<h3>Category: <?php echo $recipe['category']; ?></h3>

<h2>Ingredients</h2>
<p><?php echo nl2br($recipe['ingredients']); ?></p>

<h2>Instructions</h2>
<p><?php echo nl2br($recipe['instructions']); ?></p>

<a href="favorite.php?id=<?php echo $recipe['id']; ?>"
class="favorite-btn">
Add To Favorites
</a>

</div>

<?php include("includes/footer.php"); ?>
