<?php
// include "./env.php";
$base_url = "http://localhost/tutorials/niit/ikorodu/projects/eduvibes/";
$site_name = "EduVibes";
$site_title = "EduVibes - Your Learning Platform";
$site_description = "EduVibes is a platform that connects students and educators, providing a space for learning and sharing knowledge.";
$routes = [
    'home' => 'index.php',
    'login' => 'auth/login.php',
    'register' => 'auth/register.php',
    'profile' => 'user/profile.php',
    'settings' => 'user/settings.php',
    'logout' => 'auth/logout.php',
    'blog' => 'blog/index.php',
    'blog_categories' => 'blog/categories.php?slug={slug}',
    'blog_details' => 'blog/details.php?id={id}',
    'contact' => 'contact.php',
    'about' => 'about.php'
];
function addRoute($route, $name) {
    global $routes;
    $routes[$name] = $route;
}
function getRoute($name, $params = []) {
    global $base_url;
    global $routes;
    if (isset($routes[$name])) {
        $route = $routes[$name];
        foreach ($params as $key => $value) {
            $route = str_replace("{" . $key . "}", $value, $route);
        }
        return $base_url . $route;
    }
    return null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo $base_url ?>assets/css/style.css">
</head>
<body>

<header class="header">
    <div class="brand">
        <a href="/">
            <b>EDUVIDES</b>
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li class="active"><a href="<?php echo getRoute("home"); ?>">Home</a></li>
            <?php if (!isset($_SESSION['user_data'])){ ?>
                <li><a href="<?php echo getRoute("login"); ?>">Login</a></li>
                <li><a href="<?php echo getRoute("register"); ?>">Register</a></li>
            <?php } else { ?>
            <li><a href="<?php echo $_SESSION['user_data']["dashboardUrl"]; ?>">Profile</a></li>
    
            <li><a href="<?php echo getRoute('logout') ?>">Logout</a></li>
            <?php } ?>
        </ul>
</header>
    
