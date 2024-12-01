<?php
include_once "config/database.php";
include_once "includes/header.php";

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM members";
$stmt = $db->prepare($query);
$stmt->execute();

$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Members</h2>
<a href="add_member.php" class="btn btn-success mb-3">Add Member</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($members as $member): ?>
        <tr>
            <td><?php echo htmlspecialchars($member['name']); ?></td>
            <td><?php echo htmlspecialchars($member['email']); ?></td>
            <td>
                <a href="edit_member.php?id=<?php echo $member['id']; ?>" class="btn btn-primary">Edit</a>
                <a href="delete_member.php?id=<?php echo $member['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include_once "includes/footer.php"; ?>
