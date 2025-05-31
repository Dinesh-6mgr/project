<?php

include "includes/header.php";
include "dbconfig.php";

// Build month-to-image map
$monthImageMap = [];
$result = $conn->query("SELECT month, file_path FROM calendar_uploads");
while ($row = $result->fetch_assoc()) {
    $monthImageMap[$row['month']] = $row['file_path'];
}
?>




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
