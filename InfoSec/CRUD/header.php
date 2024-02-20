<!DOCTYPE hhtml>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
<style>

body {
    margin: 0;
    padding: 0;
    font-family: 'Nunito Sans', sans-serif;
    background-color: #26334e; /* Change background color */
}

h2 {
    color: #e7dbb9; /* Change color of h2 tag */
}

    nav {
    background-color: white; /* Set background color to white */
    height: 60px;
    display: flex;
    justify-content: space-between; /* Change to space-between to move branding to the left */
    align-items: center;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    text-decoration: none;
    border-bottom: 1px solid black; /* Add border under the navbar */
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: flex-end; /* Change to flex-end to align items to the right */
    align-items: center;
}

nav li {
    display: inline-block;
    margin: 0 10px;
    text-decoration: none;
    border-right: 1px solid black; /* Add border between anchors */
    padding-right: 10px; /* Add padding to separate anchors visually */
}

nav li:last-child {
    border-right: none; /* Remove border from last anchor */
}

nav a {
    color: black;
    text-decoration: none;
    padding: 10px;
    position: relative;
}

nav a:after {
    content: "";
    height: 3px;
    background-color: #f1c40f;
    position: absolute;
    left: 0;
    right: 0;
    bottom: -1px;
    opacity: 0;
    transition: opacity 0.3s, transform 0.3s;
    transform: scaleX(0);
}

nav a:hover:after {
    opacity: 1;
    transform: scaleX(1);
}

.branding {
    margin-left: 20px; /* Adjust as needed to move the branding further left */
}

.branding a {
    color: black;
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
}

    .box1 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .box1 .buttons {
        display: flex;
    }

    .box1 .buttons button {
    margin-right: 10px;
    background-color: #086bae; /* Change button background color */
    border-color: #086bae; /* Change button border color */
    color: white; /* Change button text color */
}
</style>
</head>
<body>

<nav>
        <div class="branding">
            <a>Task Man</a>
        </div>
        <ul>
            <li><a> </a></li>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="archived_tasks.php">Archives</a></li>
            <li><a href="private_password_form.php">Private</a></li>
            <li><a href="logs_page.php">Logs</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
    </nav>
    <br><br><br><br>
    
    <div class="container">

    