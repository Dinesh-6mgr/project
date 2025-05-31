<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"> -->

  <title>dinesh</title>
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

  <!-- Navbar -->
  <div class="navbar">
    <div class="logo">EMBOCES</div>
    <div class="menu-icon" onclick="toggleSidebar()">☰</div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <ul>
      <li><a href="user.php">   Grid 2081 </a></li>
        <li><a href="user_calendar.php">calendar</a></li>
         <li><a href="contact.php">Contact us</a></li>
         <li><a href="./login.php">admin </a></li>
    </ul>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>