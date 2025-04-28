<?php
include_once "./checkAuth.php";
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php
    include_once "../database/form_css/dashboard.php";
    ?>
</head>

<body>
    <header class="header">
        <div class="brand">
            <a href="/">
                <b>PHP BATCHC</b>
            </a>
        </div>
        <nav class="navbar">
            <ul>
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="http://localhost/tutorials/niit/ikorodu/batch-c/authentication/logout.php">Logout</a></li>
            </ul>
    </header>
    <div class="page_content">
        <div class="page_content_wrapper">
            <h1>Dashboard</h1>
            <p>Welcome to the dashboard, <b> <?php echo $user['name']; ?>!</p> </b>
            <p>Your email is: <b> <?php echo $user['email']; ?></p></b>
        </div>
        <br>
        <hr>

        <div class="ajax_page_wrapper">
            <h1>
                Send Email Form
            </h1>
            <div class="formDiv">
                <div class="form_input_wrapper">
                    <label for="name">Name:</label>
                    <input type="text" id="name" placeholder="Enter Name">
                </div>

                <div class="form_input_wrapper">
                    <label for="email">Email:</label>
                    <input type="text" id="email" placeholder="Enter Email">
                </div>

                <div class="form_input_wrapper">
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" placeholder="Enter Subject">
                </div>

                <div class="form_input_wrapper">
                    <label for="message">Message:</label>
                    <textarea id="message" rows="4"></textarea>
                 </div>

                <button id="submitBtn">Submit</button>

            </div>


        </div>
    </div>

    <script>
        var submitBtn = document.getElementById("submitBtn");
        submitBtn.addEventListener("click", SendEmail);
    
        function SendEmail() {

            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var subject = document.getElementById("subject").value;
            var message = document.getElementById("message").value;
            var formData = new FormData();
            formData.append("name", name);
            formData.append("email", email);
            formData.append("subject", subject);
            formData.append("message", message);

            var addUderUrl = "http://localhost/tutorials/niit/ikorodu/batch-c/authentication/ajax_send_email.php";
            
            fetch(addUderUrl, {
                    method: 'POST',
                    body: formData
                })
                .then((response) => response.json())
                .then((data) => {
                    if(data.status===200){
                        alert(data.message);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }else{
                        alert(data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            return false;
        }

       

   

        
    </script>

</body>

</html>