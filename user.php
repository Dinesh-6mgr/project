<?php
include "includes/header.php";
include "dbconfig.php";

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
 <?php
include "includes/footer.php";
?>