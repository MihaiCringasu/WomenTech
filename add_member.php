<?php
include_once "config/database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO members (name, email, profession, company, linkedin) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['profession'],
        $_POST['company'],
        $_POST['linkedin']
    ]);
    header("Location: members.php");
    exit();
}
?>

<?php include_once "includes/header.php"; ?>
<div class="form-container">
    <h2>Add Member</h2>
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
            <label>Profession</label>
            <input type="text" name="profession" class="form-control">
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text" name="company" class="form-control">
        </div>
        <div class="form-group">
            <label>LinkedIn Profile</label>
            <input type="url" name="linkedin" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Member</button>
    </form>
</div>
<?php include_once "includes/footer.php"; ?>
