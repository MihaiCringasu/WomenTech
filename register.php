<?php
include_once "config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        md5($_POST['password']),
        'member'
    ]);
    header("Location: login.php");
    exit();
}
?>

<?php include_once "includes/header.php"; ?>
<div class="form-container">
    <h2>Register</h2>
    <form method="POST">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
<?php include_once "includes/footer.php"; ?>
