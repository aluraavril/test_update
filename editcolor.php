<?php 
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Color</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <?php $getColorByID = getColorByID($pdo, $_GET['color_id']); ?>
        <h1>Edit Color</h1>
        <form action="core/handleForms.php?color_id=<?php echo $_GET['color_id']; ?>" method="POST" class="form">
            <input type="hidden" name="added_by" value="<?php echo $_SESSION['user_id']; ?>">
            <p>
                <label for="colorName">Color Name:</label>
                <input type="text" name="colorName" value="<?php echo $getColorByID['color_name']; ?>" required>
            </p>
            <p>
                <label for="dealerName">Dealer Name:</label>
                <input type="text" name="dealerName" value="<?php echo $getColorByID['dealer_name']; ?>" required>
            </p>
            <input type="submit" name="editColorBtn" value="Update Color" class="btn">
        </form>
        <a href="index.php" class="btn btn-cancel">Cancel</a>
    </div>
</body>
</html>