<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
require_once 'dbConfig.php';
require_once 'models.php';

// Insert Color
if (isset($_POST['insertColorBtn'])) {
    $query = insertColor($pdo, $_POST['colorName'], $_POST['dealerName'], $_SESSION['user_id']);
    if ($query) {
        $_SESSION['message'] = "Color added successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Failed to add color";
        $_SESSION['message_type'] = "error";
    }
    header("Location: ../index.php");
    exit;
}

// Edit Color
if (isset($_POST['editColorBtn'])) {
    $query = updateColor($pdo, $_POST['colorName'], $_POST['dealerName'], $_GET['color_id'], $_SESSION['user_id']);
    if ($query) {
        $_SESSION['message'] = "Color updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "You don't have permission to edit this color";
        $_SESSION['message_type'] = "error";
    }
    header("Location: ../index.php");
    exit;
}

// Delete Color
if (isset($_POST['deleteColorBtn'])) {
    $query = deleteColor($pdo, $_GET['color_id'], $_SESSION['user_id']);
    if ($query) {
        $_SESSION['message'] = "Color deleted successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "You don't have permission to delete this color";
        $_SESSION['message_type'] = "error";
    }
    header("Location: ../index.php");
    exit;
}

// Insert Bettor
if (isset($_POST['insertBettorBtn'])) {
    $query = insertBettor(
        $pdo, 
        $_POST['bettor_firstname'], 
        $_POST['betting_price'], 
        $_POST['color_id'],
        $_SESSION['user_id']  // Add the user_id here
    );
    if ($query) {
        header("Location: ../viewbettors.php?color_id=" . $_POST['color_id']);
        exit;
    } else {
        echo "Insertion failed";
    }
}
// Edit Bettor
if (isset($_POST['editBettorBtn'])) {
    $query = updateBettor($pdo, $_POST['bettor_firstname'], $_POST['betting_price'], $_GET['bettor_id'], $_SESSION['user_id']);
    if ($query) {
        $_SESSION['message'] = "Bettor updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "You don't have permission to edit this bettor";
        $_SESSION['message_type'] = "error";
    }
    header("Location: ../viewbettors.php?color_id=" . $_POST['color_id']);
    exit;
}

// Delete Bettor
if (isset($_POST['deleteBettorBtn'])) {
    $query = deleteBettor($pdo, $_GET['bettor_id'], $_SESSION['user_id']);
    if ($query) {
        $_SESSION['message'] = "Bettor deleted successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "You don't have permission to delete this bettor";
        $_SESSION['message_type'] = "error";
    }
    header("Location: ../viewbettors.php?color_id=" . $_POST['color_id']);
    exit;
}
?>