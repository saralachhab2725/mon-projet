<?php
require_once "pdo.php";
require_once "util.php";
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Lachhab Sara - Resume Registry</title>
</head>
<body>
<h1>Profiles</h1>

<?php
flashMessage();

$stmt = $pdo->query("SELECT profile_id, first_name, last_name, headline FROM Profile");
echo('<table border="1">');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>";
    echo '<a href="view.php?profile_id='.htmlentities($row['profile_id']).'">'
         .htmlentities($row['first_name']).' '.htmlentities($row['last_name']).'</a>';
    echo "</td><td>".htmlentities($row['headline'])."</td>";

    if (isset($_SESSION['user_id'])) {
        echo "<td>";
        echo '<a href="edit.php?profile_id='.$row['profile_id'].'">Edit</a> / ';
        echo '<a href="delete.php?profile_id='.$row['profile_id'].'">Delete</a>';
        echo "</td>";
    }
    echo "</tr>\n";
}
echo "</table>\n";

if (!isset($_SESSION['name'])) {
    echo '<p><a href="login.php">Please log in</a></p>';
} else {
    echo '<p><a href="add.php">Add New Entry</a> | <a href="logout.php">Logout</a></p>';
}
?>
</body>
</html>



