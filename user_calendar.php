<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "dinesh rana magar");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Build month-to-image map
$monthImageMap = [];
$result = $conn->query("SELECT month, file_path FROM calendar_uploads");
while ($row = $result->fetch_assoc()) {
    $monthImageMap[$row['month']] = $row['file_path'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="index.css">
  <script src="index.js" defer></script>
    <title>Calendar Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f3;
            padding: 0px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .nav a {
            margin: 0 10px;
            text-decoration: none;
            color: #444;
            font-weight: bold;
        }

        .nav a:hover {
            color: #007bff;
        }

        .filter-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .filter-box select {
            padding: 8px;
            width: 250px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .calendar-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .calendar-image img {
            max-width: 100%;
            height: auto;
            display: none;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px #aaa;
        }

        table {
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
            background: #2c3e50;
            color: white;
        }

        table td a {
            color: #007bff;
            text-decoration: none;
        }

        table td a:hover {
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
     <div class="navbar">
    <div class="logo">EMBOCES</div>
    <div class="menu-icon" onclick="toggleSidebar()">☰</div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <ul>
                <li><a href="index.html">Home</a></li>
      <li><a href="user.php">   Grid 2081 </a></li>
         <li><a href="contact.html">Contact us</a></li>
         <li><a href="login.php">admin </a></li>
    </ul>
  </div>



<h2> Public Calendar Uploads</h2>

<div class="filter-box" style="margin: 20px auto; max-width: 300px; text-align: center;">
    <select id="monthDropdown" onchange="filterTableAndImage()" 
        style="width: 100%; padding: 10px 15px; font-size: 16px; border: 2px solid #3498db; border-radius: 6px; background-color: #fff; color: #333; cursor: pointer; transition: border-color 0.3s ease;">
        <option value="">-- Select Nepali Month --</option>
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
</div>


<div class="calendar-image">
    <img id="calendarImage" src="" alt="Month Calendar">
</div>

<table id="calendarTable" style="display:none;">
    <tr>
        <th>ID</th>
        <th>Month</th>
        <th>View Calendar</th>
        <th>Uploaded At</th>
    </tr>
    <?php
    $allUploads = $conn->query("SELECT * FROM calendar_uploads ORDER BY uploaded_at DESC");
    while ($row = $allUploads->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['month']}</td>
                <td><a href='{$row['file_path']}' target='_blank'>View</a></td>
                <td>{$row['uploaded_at']}</td>
              </tr>";
    }
    ?>
</table>
<body>
  <div class="page-container">
    <!-- Your whole page content here -->
  </div>

  <div class="footer">
    <p>© 2025 MyWebsite. All rights reserved.</p>
  </div>
</body>

<script>
    // JS object mapping month to image path
    const monthImageMap = <?php echo json_encode($monthImageMap); ?>;

    function filterTableAndImage() {
        const dropdown = document.getElementById("monthDropdown");
        const selectedMonth = dropdown.value;
        const table = document.getElementById("calendarTable");
        const rows = table.getElementsByTagName("tr");
        const image = document.getElementById("calendarImage");

        for (let i = 1; i < rows.length; i++) {
            const monthCell = rows[i].getElementsByTagName("td")[1];
            if (monthCell) {
                const monthText = monthCell.textContent || monthCell.innerText;
                rows[i].style.display = selectedMonth === "" || monthText === selectedMonth ? "" : "none";
            }
        }

        // Show the image only if a valid image exists
        if (selectedMonth && monthImageMap[selectedMonth]) {
            image.src = monthImageMap[selectedMonth];
            image.style.display = "block";
        } else {
            image.style.display = "none";
        }
    }
</script>

</body>
</html>

<?php $conn->close(); ?>
