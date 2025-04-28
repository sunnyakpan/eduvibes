<?php
include_once "../auth/checkAuth.php";
$user = $_SESSION['user_data'];

include "../includes/header.php";
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
    === 'on' ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER['REQUEST_URI'];


$baseUrl = $_SESSION['user_data']["baseUrl"];
$dashboardNavs =[
    [
        "name"=>"Dashboard",
        "link"=>$baseUrl."dashboard.php"
    ],
    [
        "name"=>"Categories",
        "link"=>$baseUrl."category/index.php"
    ],
    [
        "name"=>"Blogs",
        "link"=>$baseUrl."blog/index.php"
    ],
 
    [
        "name"=>"Users",
        "link"=>$baseUrl."user/index.php"
    ]
];
?>


<div class="page_content">
    <div class="page_content_wrapper">
        <h1>Dashboard</h1>
        <p>Welcome to the dashboard, <b> <?php echo $user['name']; ?>!</p> </b>
        <p>Your email is: <b> <?php echo $user['email']; ?></p></b>
    </div>
    <br>
    <ul class="dashboardNav">
        <?php foreach ($dashboardNavs as $nav) { ?>
            
        <li>
            <a class="<?php echo $nav['link'] ==$link? 'active':'' ?>" href="<?php echo $nav['link'] ?>"><?php echo $nav['name'] ?></a>
        </li>
        <?php } ?>

    </ul>
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
                if (data.status === 200) {
                    alert(data.message);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
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