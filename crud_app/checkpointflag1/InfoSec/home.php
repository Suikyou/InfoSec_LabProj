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

    <title>Ritika Navbar</title>
<style> 
   body {
    margin: 0;
    padding: 0;
    font-family: 'Nunito Sans', sans-serif;
    background-color: #F3EEEA;
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


footer {
            background-color: #B0A695; /* Set the desired background color */
            color: #F3EEEA; /* Set the text color for the footer */
            text-align: center;
            padding: 10px;
            bottom: 0;
            width: 100%;
        }

#about {
    background-color: #B0A695; /* Set the desired background color */
    color: #41444B;
}

/* Add margin-top to the carousel */
#carouselExample {
    margin-top: 60px; /* Adjust the value as needed */
    position: relative;
    z-index: 1; /* Set a lower z-index */
}
</style>
</head>
<body>
<nav>
        <div class="branding">
            <a>Task Man</a>
        </div>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="login.php">Sign up</a></li>
        </ul>
    </nav>
      
      <div id="home">
        <div class="text-center heading">
          Home
        </div>
        <div class="dummy-text">
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/c2.png" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="images/c1.png" class="d-block w-100" alt="Image 2">
            </div>
            <!-- Add more carousel items as needed -->
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>      
        </div>
      </div>
      <div id="about">
        <div class="text-center heading">
          About
        </div>
        <div class="dummy-text">
        <strong>Introducing <i>Task Manager:</i> </strong> The Sophisticated Solution for Effortless <i>Task Manager</i><br> <br>
        Tired of juggling endless to-do lists and scattered reminders? Say goodbye to disorganization and hello to <i>Task Manager</i>, the revolutionary task management software designed by developers, for developers. We understand the demands of a fast-paced environment, where tasks pile up and deadlines loom. That's why we've created a solution that goes beyond basic reminders – it empowers you to conquer your workload with unparalleled efficiency and sophistication. <br> <br> <br> 
        <strong>More Than Just a Task Manager:</strong><br><br>
            <i>Task Manager</i> is more than just a place to store tarefas. It's a comprehensive solution that empowers developers to:<br><br>
            
            <ul>
                <li><strong>Boost Productivity:</strong> Work smarter, not harder, with tools that optimize your time and effort.</li>
                <li><strong>Reduce Stress:</strong> Eliminate the chaos of juggling multiple tasks and achieve greater peace of mind.</li>
                <li><strong>Gain Insights:</strong> Make data-driven decisions and continuously improve your workflow for enhanced individual and team performance.</li>
            </ul> <br><br>
        <strong>Join the Revolution in Task Management:</strong>

Experience the power of <i>Task Manager </i> and unlock a new level of productivity. Sign up today and discover how our sophisticated solution can transform the way you work.
        </div>
      </div>
      <div id="services">
        <div class="text-center heading">
          Services
        </div>
        <div class="dummy-text">
        <h2>Basic Needs:</h2>
    <ul>
        <li>Task creation and management: Add, edit, and delete tasks with ease.</li>
        <li>Due dates and reminders: Set deadlines and receive timely notifications to stay on track.</li>
        <li>Task lists and categories: Organize tasks into thematic lists and categories for easy access.</li>
        <li>Subtasks and checklists: Break down complex tasks into smaller, manageable steps.</li>
        <li>Prioritization: Mark tasks as urgent, important, or low priority for focused work.</li>
        <li>Progress tracking: Monitor the completion status of each task at a glance.</li>
        <li>Offline access: Manage tasks even without an internet connection.</li>
    </ul>

    <h2>Collaboration and Communication:</h2>
    <ul>
        <li>Shared tasks and lists: Collaborate with teammates by assigning and sharing tasks.</li>
        <li>Real-time updates: See changes made by others instantly for seamless collaboration.</li>
        <li>Task comments and discussions: Discuss tasks within the app for clear communication.</li>
        <li>File sharing: Attach relevant documents and files to tasks for easy reference.</li>
        <li>Team dashboards: Track team progress and individual contributions for improved accountability.</li>
    </ul>

    <h2>Advanced Features:</h2>
    <ul>
        <li>Recurring tasks: Automate repetitive tasks for effortless time management.</li>
        <li>Integrations: Connect with your favorite tools like calendar, email, and project management platforms.</li>
        <li>Customizable workflows: Set up specific workflows for different types of tasks or projects.</li>
        <li>Templates: Leverage pre-built templates for common tasks to save time and effort.</li>
        <li>Tags and labels: Add custom tags and labels for further task organization and filtering.</li>
        <li>Analytics and reporting: Gain insights into your productivity with detailed reports and visualizations.</li>
        <li>Mobile app: Manage tasks on the go with a user-friendly mobile app.</li>
    </ul>

    <h2>Premium Services:</h2>
    <ul>
        <li>Increased storage space: Store more tasks, files, and attachments with upgraded storage plans.</li>
        <li>Priority support: Get faster and more personalized assistance from the support team.</li>
        <li>Advanced security features: Enhance data security with additional encryption and access controls.</li>
        <li>Team management features: Manage user roles, permissions, and billing for larger teams.</li>
        <li>Custom branding: Customize the app interface with your team's logo and branding.</li>
    </ul>   
        </div>
      </div>
    <footer>
        &copy; Grp11 est 2024
    </footer>
</body>
</html>