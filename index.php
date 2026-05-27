<?php
session_start();
include("config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/*
========================================
SEARCH
========================================
*/
$search = $_GET['search'] ?? "";
$searchTerm = "%$search%";

$sql = "SELECT * FROM recipes 
        WHERE user_id = ? 
        AND (title LIKE ? OR category LIKE ?)
        ORDER BY id DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

/*
========================================
STATS (CLEANED + FIXED)
========================================
*/
$totalRecipes = $conn->query("SELECT COUNT(*) AS total FROM recipes WHERE user_id=$user_id")
->fetch_assoc()['total'];

$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];

$totalLikes = $conn->query("SELECT COUNT(*) AS total FROM likes")->fetch_assoc()['total'];

$categories = $conn->query("
    SELECT category, COUNT(*) as count 
    FROM recipes 
    GROUP BY category
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Recipe Dashboard</title>

<style>
:root{
    --orange:#ff7a18;
    --dark:#0f0f0f;
    --brown:#5a3e2b;
    --white:#ffffff;
}

/* BASE */
body{
    margin:0;
    font-family:Arial;
    background:var(--dark);
    color:var(--white);
}

/* TOPBAR */
.topbar{
    background:var(--brown);
    padding:15px;
    display:flex;
    justify-content:space-between;
    flex-wrap:wrap;
    align-items:center;
}

.topbar h2{
    color:var(--orange);
}

/* SEARCH */
input{
    padding:10px;
    border:none;
    border-radius:8px;
}

/* STATS */
.stats{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:15px;
    padding:20px;
}

.card{
    background:var(--brown);
    padding:15px;
    border-radius:10px;
    text-align:center;
    transition:0.3s;
}

.card:hover{
    background:var(--orange);
    transform:scale(1.05);
}

/* GRID */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
    padding:20px;
}

/* CARD */
.recipe{
    background:#1c1c1c;
    border-radius:12px;
    overflow:hidden;
    border:1px solid var(--brown);
    transition:0.3s;
}

.recipe:hover{
    transform:translateY(-6px);
    border-color:var(--orange);
}

.recipe img{
    width:100%;
    height:180px;
    object-fit:cover;
}

/* CONTENT */
.content{
    padding:15px;
}

.title{
    color:var(--orange);
    font-size:18px;
}

/* BUTTONS */
.btn{
    padding:8px 10px;
    margin:5px 5px 0 0;
    border-radius:6px;
    border:none;
    cursor:pointer;
    font-size:12px;
}

.view{ background:var(--orange); }
.edit{ background:var(--brown); color:white; }
.delete{ background:#c0392b; color:white; }
.like{ background:white; }

/* MOBILE */
@media(max-width:600px){
    .topbar{
        flex-direction:column;
        gap:10px;
    }
}
</style>
</head>

<body>

<!-- TOPBAR -->
<div class="topbar">
    <h2>🍲 Recipe Dashboard</h2>

    <form method="GET">
        <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>">
    </form>
</div>

<!-- STATS -->
<div class="stats">
    <div class="card">
        <h3><?php echo $totalRecipes; ?></h3>
        <p>My Recipes</p>
    </div>

    <div class="card">
        <h3><?php echo $totalUsers; ?></h3>
        <p>Users</p>
    </div>

    <div class="card">
        <h3><?php echo $totalLikes; ?></h3>
        <p>Total Likes</p>
    </div>
</div>

<!-- CATEGORY ANALYTICS -->
<div style="padding:20px;">
    <h3 style="color:var(--orange)">📊 Categories</h3>

    <?php while($c = $categories->fetch_assoc()): ?>
        <p><?php echo $c['category']; ?> → <?php echo $c['count']; ?></p>
    <?php endwhile; ?>
</div>

<!-- RECIPES -->
<div class="grid">

<?php while($row = $result->fetch_assoc()): ?>

<div class="recipe" id="recipe-<?php echo $row['id']; ?>">

    <img src="assets/uploads/<?php echo $row['image']; ?>">

    <div class="content">

        <div class="title"><?php echo $row['title']; ?></div>
        <small><?php echo $row['category']; ?></small>

        <div>

            <a class="btn view" href="recipe.php?id=<?php echo $row['id']; ?>">View</a>

            <a class="btn edit" href="edit_recipe.php?id=<?php echo $row['id']; ?>">Edit</a>

            <button class="btn delete" onclick="deleteRecipe(<?php echo $row['id']; ?>)">
                Delete
            </button>

            <button class="btn like" onclick="likeRecipe(<?php echo $row['id']; ?>)">
                ❤️ Like
            </button>

        </div>

    </div>
</div>

<?php endwhile; ?>

</div>

<script>

/*
========================================
DELETE (NO RELOAD - SMOOTH UI)
========================================
*/
function deleteRecipe(id){

    if(!confirm("Delete this recipe?")) return;

    fetch("ajax/delete_recipe.php?id=" + id)
    .then(res => res.text())
    .then(data => {
        if(data.trim() === "deleted"){
            document.getElementById("recipe-" + id).remove();
        }
    });
}

/*
========================================
LIKE SYSTEM
========================================
*/
function likeRecipe(id){

    fetch("ajax/like_recipe.php?id=" + id)
    .then(res => res.text())
    .then(data => {
        alert(data);
    });
}

</script>

</body>
</html>
