<?php
require_once "pdo.php";
session_start();
if (!isset($_SESSION['user_id'])) die("Not logged in");

if (isset($_POST['first_name'])) {
    foreach(['first_name','last_name','email','headline','summary'] as $field) {
        if (empty($_POST[$field])) {
            $_SESSION['error'] = "All fields are required";
            header("Location: add.php");
            return;
        }
    }
    if (!strpos($_POST['email'],'@')) {
        $_SESSION['error'] = "Email address must contain @";
        header("Location: add.php");
        return;
    }

    $stmt = $pdo->prepare('INSERT INTO Profile (user_id, first_name, last_name, email, headline, summary)
        VALUES (:uid,:fn,:ln,:em,:he,:su)');
    $stmt->execute(array(
        ':uid'=>$_SESSION['user_id'],
        ':fn'=>$_POST['first_name'],
        ':ln'=>$_POST['last_name'],
        ':em'=>$_POST['email'],
        ':he'=>$_POST['headline'],
        ':su'=>$_POST['summary']
    ));
    $_SESSION['success'] = "Profile added";
    header("Location: index.php");
    return;
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Profile - Lachhab Sara</title></head>
<body>
<h1>Add Profile</h1>
<?php require_once "util.php"; flashMessage(); ?>
<form method="post">
First Name: <input type="text" name="first_name"><br>
Last Name: <input type="text" name="last_name"><br>
Email: <input type="text" name="email"><br>
Headline: <input type="text" name="headline"><br>
Summary:<br>
<textarea name="summary" rows="8" cols="80"></textarea><br>
<input type="submit" value="Add">
</form>
<p><a href="index.php">Cancel</a></p>
</body>
</html>
