<?php
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