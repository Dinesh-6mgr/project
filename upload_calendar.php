<?php
session_start();

// Block access if not logged in

// Set allow_calendar only if accessed from admin.php
if (isset($_GET['fromadmin']) && $_GET['fromadmin'] == 1) {
    $_SESSION['allow_calendar'] = true;
}

// Only allow if allow_calendar flag is set
if (!isset($_SESSION['allow_calendar']) || $_SESSION['allow_calendar'] !== true) {
    header("Location: admin.php");
    exit();
}

// Clear the access flag after one use
unset($_SESSION['allow_calendar']);


// then your full calendar upload/view logic below



// DB connection
$conn = new mysqli("localhost", "root", "", "dinesh rana magar");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create photo folder if not exists
$uploadDir = "photo/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$message = "";

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload"])) {
    $month = htmlspecialchars(trim($_POST["month"]));
    $safeMonth = preg_replace("/[^a-zA-Z0-9_-]/", "", $month);

    if (isset($_FILES["calendar"]) && $_FILES["calendar"]["error"] == 0) {
        $fileName = $_FILES["calendar"]["name"];
        $fileTmp = $_FILES["calendar"]["tmp_name"];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt === "jpg" || $fileExt === "jpeg") {
            $newFileName = $uploadDir . $safeMonth . "-" . time() . ".jpg";
            if (move_uploaded_file($fileTmp, $newFileName)) {
                $stmt = $conn->prepare("INSERT INTO calendar_uploads (month, file_path) VALUES (?, ?)");
                $stmt->bind_param("ss", $month, $newFileName);
                $stmt->execute();
                $message = "<div class='alert success'>✅ Uploaded and saved to DB.</div>";
            } else {
                $message = "<div class='alert error'>❌ Upload failed.</div>";
            }
        } else {
            $message = "<div class='alert error'>❌ Only JPG files are allowed.</div>";
        }
    }
}

// Handle deletion
if (isset($_GET["delete"])) {
    $id = intval($_GET["delete"]);
    $result = $conn->query("SELECT file_path FROM calendar_uploads WHERE id=$id");
    if ($row = $result->fetch_assoc()) {
        if (file_exists($row["file_path"])) {
            unlink($row["file_path"]);
        }
        $conn->query("DELETE FROM calendar_uploads WHERE id=$id");
        $message = "<div class='alert success'>🗑️ File deleted successfully.</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Calendar JPG</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
        }

        h2, h3 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
            max-width: 400px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"], input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        input[type="submit"] {
            background: rgb(22, 27, 23);
            border: none;
            padding: 10px 15px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: rgb(27, 32, 28);
        }

        table {
            margin-top: 30px;
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 0 10px #ccc;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background: rgb(12, 14, 15);
            color: white;
        }

        table td a {
            color: #dc3545;
            text-decoration: none;
            font-weight: bold;
        }

        table td a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
            max-width: 500px;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }

        .view-link {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div>
    <div style="display: flex; justify-content: flex-end; gap: 10px; margin: 20px 0;">
    <a href="upload_pdf.php" style="text-decoration: none;">Upload PDF</a>
<a href="admin.php?fromadmin=1" style="text-decoration: none;">contact</a>
<a href="logout.php" style="text-decoration: none;">Logout</a>

    
</div>

    <h2>Upload Calendar JPG</h2>

    <?php echo $message; ?>

    <form action="" method="post" enctype="multipart/form-data">
       <label>Month:</label>
<select name="month" required>
    <option value="">-- Select Month --</option>
    <option value="Baisakh">Baisakh</option>
    <option value="Jestha">Jestha</option>
    <option value="Ashadh">Ashadh</option>
    <option value="Shrawan">Shrawan</option>
    <option value="Bhadra">Bhadra</option>
    <option value="Ashwin">Ashwin</option>
    <option value="Kartik">Kartik</option>
    <option value="Mangsir">Mangsir</option>
    <option value="Poush">Poush</option>
    <option value="Magh">Magh</option>
    <option value="Falgun">Falgun</option>
    <option value="Chaitra">Chaitra</option>
</select>

        <label>Choose JPG File:</label>
        <input type="file" name="calendar" accept=".jpg,.jpeg" required>

        <input type="submit" name="upload" value="Upload">
    </form>

    <h3>Uploaded Calendars</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Month</th>
            <th>File</th>
            <th>Uploaded At</th>
            <th>Action</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM calendar_uploads ORDER BY uploaded_at DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['month']}</td>
                    <td><a class='view-link' href='{$row['file_path']}' target='_blank'>View</a></td>
                    <td>{$row['uploaded_at']}</td>
                    <td><a href='?delete={$row['id']}' onclick='return confirm(\"Delete this file?\")'>Delete</a></td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
