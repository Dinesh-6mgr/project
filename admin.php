<?php

include "dbconfig.php";
session_start();
include "unset_session.php";



// Delete message if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM rana WHERE id=$id");
    header("Location: admin.php");
    exit();
}

// Get all messages
$result = $conn->query("SELECT * FROM rana ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Contact Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f6f8;
        margin: 0;
        padding: 20px;
    }

    h2, h3 {
        color: #333;
    }

    form {
        max-width: 500px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
    }

    form select,
    form input[type="text"],
    form input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
    }

    form select:focus,
    form input[type="text"]:focus,
    form input[type="file"]:focus {
        border-color: #000;
        outline: none;
    }

    form button {
        width: 100%;
        background-color: #000;
        color: white;
        padding: 12px 0;
        font-size: 16px;
        font-weight: 700;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    form button:hover {
        background-color: #1a1a1a;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-top: 30px;
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    a {
        text-decoration: none;
        color: #05070a;
    }

    a:hover {
        text-decoration: underline;
    }

    .success {
        color: green;
        font-weight: bold;
    }

    .error {
        color: red;
        font-weight: bold;
    }

    .top-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin: 20px 0;
    }

    .top-actions .btn {
        background-color: #6c757d;
        color: white;
        padding: 6px 12px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s;
    }

    .top-actions .btn:hover {
        background-color: #5a6268;
    }

    br {
        margin-bottom: 10px;
    }

    </style>
</head>
<body class="bg-light">

<div>
    <div style="display: flex; justify-content: flex-end; gap: 10px; margin: 20px 0;">
    <a href="upload_pdf.php" > Upload PDF</a>
<a href="upload_calendar.php?fromadmin=1">Calendar</a>
    <a href="logout.php" > Logout</a>
    
</div>

    <h2 class="mb-4">Admin Panel - Contact Messages</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['subject']) ?></td>
                <td><?= htmlspecialchars($row['message']) ?></td>
                <td>
                    <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Are you sure you want to delete this message?');">
                       Delete
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php $conn->close(); ?>
