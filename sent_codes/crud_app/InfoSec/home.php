<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Satisfy&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>Task Manager</title>
<style> 
   body {
    margin: 0;
    padding: 0;
    font-family: 'Nunito Sans', sans-serif;
    background-color: #26334e;
}

.heading {
    text-align: center;
    font-size: 35px;
    font-weight: 600;
    padding-top: 60px;
    font-family: 'Satisfy', cursive;
}

.dummy-text {
    padding: 0.5rem 1.5rem;
    line-height: 120%;
    font-size: 18px;
    font-weight: 500;
}

.dummy-text ul {
    padding-left: 80px; /* Adjust the indentation as needed */
    max-width: 1000px; /* Adjust the max-width as needed */
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
.tagline {
    position: fixed;
    bottom: 300px;
    left: 120px;
    font-size: 18px;
    color: #e7dbb9;
    padding: 10px;
    width: 50%;
  }

  .tagline h1{
    font-size: 50px;
    margin-bottom: 2%;
  }

  .tagline h3{
    font-size: 22px;
    margin-bottom: 2%;
    color: #d39730;
  }

  .tagline p {
  opacity: .6; /* Adjust the opacity value as needed */
  width: 45%;
  color: white;
}

.image-container {
    position: fixed;
    bottom: 30%; /* Adjust the position relative to the bottom of the viewport */
    left: 50%; /* Adjust the position relative to the left of the viewport */
    border: 2px solid #e4f4fb; /* Add a white border with 2px width */
    border-radius: 0.1%; /* Make the border rounded */
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 10); /* Add shadow with a blur radius of 10px */
}
footer {
            background-color: #B0A695; /* Set the desired background color */
            color: #F3EEEA; /* Set the text color for the footer */
            text-align: center;
            padding: 10px;
            bottom: 0;
            width: 100%;
        }
.button-container {
    position: fixed;
    bottom: 10%; /* Adjust as needed */
    left: 10%;
    transform: translateX(-50%);
}

.button-container a.button {
    padding: 10px 20px;
    background-color: #b04f34;
    border: none;
    border-radius: 5px;
    color: #e7dbb9;
    font-size: 16px;
    cursor: pointer;
}
</style>
</head>
<body>
    <nav>
        <div class="branding">
        </br>
        <p style="font-size: 40px;">Task Manager</p>
        </div>
        <ul>
            <li><a href="register.php">Sign up</a></li>
        </ul>
    </nav>
    <div id="home">
    <div class="image-container">
    <img src="images/home1.png" alt="Description of your image" width="800" height="450">
    </div>

<div class="tagline">
    <h1> Streamline Your Tasks, <br>Simplify Your Life </h1>
    <br>
        <h3>  Our Simple Task Manager - Effortless Organization, Total Control. </h3>
        <p>Streamlines task organization with a user-friendly interface, allowing users to effortlessly add, update, and monitor tasks in one place. Users have full control over task management, including creation, updates, archiving, and deletion, ensuring accuracy and focus on goals. The platform's adaptability and features like CRUD operations enhance productivity and help users gain insights for successful task completion.</p>
</div>

    </div> 

    <hr>
    <div class="button-container">
    <a href="login.php" class="button">LOGIN</a>
</div>
</body>

</html>