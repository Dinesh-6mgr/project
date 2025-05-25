<?php
$conn = new mysqli("localhost", "root", "", "dinesh rana magar");

$classFilter = $_GET['class'] ?? '';
$subjectFilter = $_GET['subject'] ?? '';

$sql = "SELECT * FROM files";
if ($classFilter && $subjectFilter) {
    $stmt = $conn->prepare("SELECT * FROM files WHERE class = ? AND subject = ? ORDER BY id DESC");
    $stmt->bind_param("ss", $classFilter, $subjectFilter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM files ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="index.css">
    <script src="index.js" defer></script>
    <title>View PDFs by Class and Subject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8f9fa;
            padding: 0 px;
        }
        h2 {
            color: #333;
        }
        form {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        select {
            padding: 10px;
            font-size: 14px;
        }
        button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #343a40;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  background: #f1f1f1;
  text-align: center;
  padding: 15px 10px;
  color: #555;
  z-index: 1000;
}

    </style>
</head>
<body style="background-color:beige;">

<!-- Navbar -->
<div class="navbar">
    <div class="logo">EMBOCES</div>
    <div class="menu-icon" onclick="toggleSidebar()">☰</div>
</div>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <ul>
        <li><a href="index.html">Home</a></li>
                <li><a href="user_calendar.php">calendar</a></li>
        <li><a href="contact.html">Contact us</a></li>
        <li><a href="login.php">Admin</a></li>
    </ul>
</div>

<!-- Overlay -->
<div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

<h2>Search PDF by Class and Subject</h2>

<form method="GET">
    <select name="class" required>
        <option value="">-- Select Class --</option>
        <?php
        $classes = ["Nursery", "KG", "Class 1", "Class 2", "Class 3", "Class 4", "Class 5", "Class 6", "Class 7", "Class 8", "Class 9", "Class 10"];
        foreach ($classes as $c) {
            echo "<option value='$c'" . ($classFilter == $c ? ' selected' : '') . ">$c</option>";
        }
        ?>
    </select>

    <select name="subject" required>
        <option value="">-- Select Subject --</option>
        <?php
        $subjects = ["Math", "Science", "English", "Nepali", "Social Studies", "Computer Science", "Health", "Economic", "Opt maths"];
        foreach ($subjects as $s) {
            echo "<option value='$s'" . ($subjectFilter == $s ? ' selected' : '') . ">$s</option>";
        }
        ?>
    </select>

    <button type="submit">Search</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Class</th>
        <th>Subject</th>
        <th>Description</th>
        <th>View</th>
        <th>Download</th>
    </tr>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['class']) ?></td>
                <td><?= htmlspecialchars($row['subject']) ?></td>
                <td><?= nl2br(htmlspecialchars($row['description'])) ?></td>
                <td><a href="<?= $row['filename'] ?>" target="_blank"> View</a></td>
                <td><a href="<?= $row['filename'] ?>" download> Download</a></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No PDF found for selected Class and Subject.</td>
        </tr>
    <?php endif; ?>
</table>
 <div class="footer">
    <p>© 2025 MyWebsite. All rights reserved.</p>
  </div>
</body>
</html>
