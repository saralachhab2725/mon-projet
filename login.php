<?php
require_once "pdo.php";
session_start();

if (isset($_POST['email']) && isset($_POST['pass'])) {
    $salt = 'XyZzy12*_';
    $check = hash('md5', $salt.$_POST['pass']);

    $stmt = $pdo->prepare('SELECT user_id, name FROM users WHERE email = :em AND password = :pw');
    $stmt->execute(array(':em' => $_POST['email'], ':pw' => $check));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row !== false) {
        $_SESSION['name'] = $row['name'];
        $_SESSION['user_id'] = $row['user_id'];
        header("Location: index.php");
        return;
    } else {
        $_SESSION['error'] = 'Email ou mot de passe incorrect';
        header("Location: login.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login - Lachhab Sara</title></head>
<body>
<h1>Please Log In</h1>
<?php require_once "util.php"; flashMessage(); ?>
<form method="post">
Email: <input type="text" name="email" id="email"><br>
Password: <input type="password" name="pass" id="id_1723"><br>
<input type="submit" onclick="return doValidate();" value="Log In">
</form>

<script>
function doValidate() {
    em = document.getElementById('email').value;
    pw = document.getElementById('id_1723').value;
    if (em == null || em == "" || pw == null || pw == "") {
        alert("Both fields must be filled out");
        return false;
    }
    if (!em.includes('@')) {
        alert("Email must contain @");
        return false;
    }
    return true;
}
</script>
</body>
</html>
