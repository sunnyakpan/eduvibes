<?php
include "../controller/Database.php";
include "../controller/User.php";

$db = new Database;
$user = new User($db);

$responseMessage = '';
$error = false;
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];


    if (empty($email)) {
        $responseMessage .= ', Email is Required';
        $error = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $responseMessage .= ', Invalid Email';
        $error = true;
    }


    if (empty($password)) {
        $responseMessage = 'Password is Required';
        $error = true;
    }

    if( $error == false) {
        $loginUser = $user->login($email, $password);
        if ($loginUser) {
            $responseMessage = 'You\'ve login Successfully';
           
            $response =  [
                "status" => 200,
                "message" => $responseMessage,
                "nextPage" => $_SESSION['user_data']['dashboardUrl'],
            ];
        } else {
            $responseMessage = 'Invalid Email or Password';
            $error = true;
            $response = [
                "status"=>400,
                "message"=> $responseMessage,
                "data"=>[]
            ];
        }
       
    }else{
        $response = [
            "status"=>400,
            "message"=> $responseMessage,
            "data"=>[]
        ];
    }
}else{
    $response = [
        "status"=>400,
        "message"=> "Invalid Request",
        "data"=>[]
    ];
}
echo json_encode($response);
?>