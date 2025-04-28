
<?php
include "../includes/header.php";
?>


<div class="ajax_page_wrapper">
    <h1>
        Login Form
    </h1>
    <div class="formDiv">


        <div class="form_input_wrapper">
            <label for="email">Email:</label>
            <input type="text" id="email" placeholder="Enter Email">
        </div>

        <div class="form_input_wrapper">
            <label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter Password">
        </div>

        <button id="submitBtn">Submit</button>

    </div>



</div>

<script>
    var submitBtn = document.getElementById("submitBtn");
    submitBtn.addEventListener("click", LoginUser);

    function LoginUser() {

        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var formData = new FormData();
        formData.append("email", email);
        formData.append("password", password);

        var addUderUrl = "http://localhost/tutorials/niit/ikorodu/projects/eduvibes/auth/ajax_loginUser.php";

        fetch(addUderUrl, {
                method: 'POST',
                body: formData
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 200) {
                    // alert(data.message);
                    window.location.href = data.nextPage;
                    // setTimeout(() => {
                    // }, 2000);
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