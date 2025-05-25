<?php
$conn = new mysqli("localhost", "root", "", "dinesh rana magar");

$uploadDir = "uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $class = htmlspecialchars($_POST['class']);
    $subject = htmlspecialchars($_POST['subject']);
    $Description = $_POST['Description']; // ✅ Fixed
    $fileName = basename($_FILES['file']['name']);
    $targetFilePath = $uploadDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    if ($fileType === "pdf") {
        if (mime_content_type($_FILES['file']['tmp_name']) === "application/pdf") {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                // ✅ Updated to include description
                $stmt = $conn->prepare("INSERT INTO files (filename, class, subject, description) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $targetFilePath, $class, $subject, $Description);
                $stmt->execute();
                echo "<p class='success'>✅ PDF uploaded successfully.</p>";
            } else {
                echo "<p class='error'>❌ Error uploading the file.</p>";
            }
        } else {
            echo "<p class='error'>❌ Invalid file type (not a PDF).</p>";
        }
    } else {
        echo "<p class='error'>❌ Only PDF files allowed.</p>";
    }
}

$result = $conn->query("SELECT * FROM files ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDF Upload System</title>
    <style>
    /* Same CSS as before, omitted here for brevity */
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
        box-shadow: 0 2px 10px rgba(73, 16, 231, 0.1);
    }

    form label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #333;
    }

    form select,
    form input[type="text"],
    form input[type="file"],
    form textarea {
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
    form input[type="file"]:focus,
    form textarea:focus {
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
        background-color: rgb(4, 6, 8);
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
<body>
    
<div class="container mt-5">
    <div class="top-actions">
        <a href="upload_calendar.php" > calendar</a>
        <a href="admin.php" >Contact</a>
        <a href="logout.php" >Logout</a>
    </div>

    <h2>📤 Upload PDF</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Class:</label>
        <select name="class" required>
            <option value="">-- Select Class --</option>
            <option value="Nursery">Nursery</option>
            <option value="KG">KG</option>
            <option value="Class 1">Class 1</option>
            <option value="Class 2">Class 2</option>
            <option value="Class 3">Class 3</option>
            <option value="Class 4">Class 4</option>
            <option value="Class 5">Class 5</option>
            <option value="Class 7">Class 7</option>
            <option value="Class 8">Class 8</option>
            <option value="Class 9">Class 9</option>
            <option value="Class 10">Class 10</option>
        </select>

        <label>Subject:</label>
        <select name="subject" required>
            <option value="">-- Select Subject --</option>
            <option value="Math">Math</option>
            <option value="Science">Science</option>
            <option value="English">English</option>
            <option value="Nepali">Nepali</option>
            <option value="Social Studies">Social Studies</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Health">Health</option>
            <option value="Moral Education">Moral Education</option>
            <option value="Physical Education">Physical Education</option>
        </select>

        <label>Description</label>
        <textarea name="Description" rows="4" placeholder="Enter a short description..."></textarea>

        <label>Select PDF File:</label>
        <input type="file" name="file" accept=".pdf" required>

        <button type="submit">Upload PDF</button>
    </form>

    <h3>📁 Uploaded Files</h3>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Class</th>
            <th>Subject</th>
            <th>Description</th>
            <th>View</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['class']) ?></td>
            <td><?= htmlspecialchars($row['subject']) ?></td>
            <td><?= htmlspecialchars($row['description']) ?></td>
            <td><a href="<?= $row['filename'] ?>" target="_blank">🔍 View</a></td>
            <td>
                <a href="<?= $row['filename'] ?>" download>⬇️ Download</a> |
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure to delete?')">🗑️ Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
