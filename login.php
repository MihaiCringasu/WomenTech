<?php
session_start();
include_once "config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $db->prepare($query);
    $stmt->execute([
        $_POST['email'],
        md5($_POST['password'])
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<?php include_once "includes/header.php"; ?>
<div class="form-container">
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
<?php include_once "includes/footer.php"; ?>
