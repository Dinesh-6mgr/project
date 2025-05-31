<?php
include "dbconfig.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM files WHERE id = $id");
    $file = $result->fetch_assoc();

    if ($file && file_exists($file['filename'])) {
        unlink($file['filename']); // delete physical file
    }

    $conn->query("DELETE FROM files WHERE id = $id"); // remove from DB
}

header("Location: upload_pdf.php");
exit;
