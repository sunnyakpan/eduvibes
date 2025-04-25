<?php

include_once "./connection.php";

// $createTableQuery = "CREATE TABLE IF NOT EXISTS users(
//     id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
//     name VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     password VARCHAR(200) NOT NULL,
//     role ENUM('admin','user') DEFAULT('user'),
//     profile_image VARCHAR(200),
//     phone_number VARCHAR(15) NOT NULL,
//     address VARCHAR(200) NOT NULL,
//     created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
// );";

// $saveQuery = mysqli_query($conn, $createTableQuery);

// if ($saveQuery) {
//     echo " Users Table is created successfully" . "<br>";
// } else {
//     // echo "Sorry Error occured:". mysqli_error($conn) . "<br>";
// }

// $createCategoryTableQuery = "CREATE TABLE IF NOT EXISTS categories(
//     id INT PRIMARY KEY AUTO_INCREMENT,
//     slug VARCHAR(255) NOT NULL UNIQUE,
//     title VARCHAR(50) NOT NULL,
//     description VARCHAR(150)
// );";

// $createTable = mysqli_query($conn, $createCategoryTableQuery);

// if($createTable){
//     echo "Category Table is created successfully" . "<br>";
// }else{
//     echo "Sorry Error occured:". mysqli_error($conn) . "<br>";
// }

// $password = md5("12345");

// $insertQuery = "INSERT INTO users(name,email,password,phone_number,role,address)
//             VALUES('Eduvibes Admin', 'admin@gmail.com','". $password ."', '0705678923','admin', 'No 60 Ayangburen, Ikorodu')
//             ";

//             $saveQuery = mysqli_query($conn, $insertQuery);

// if ($saveQuery) {
//     echo "User Data is Inserted successfully" . "<br>";
// } else {
//     echo "Error " . mysqli_error($conn) . "<br>";
// }


// Modify the `id` column in `categories` table to be UNSIGNED and AUTO_INCREMENT
$alterCategoriesTableQuery = "ALTER TABLE categories MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT;";
$alterCategoriesTable = mysqli_query($conn, $alterCategoriesTableQuery);

if ($alterCategoriesTable) {
    echo "Categories table modified successfully.<br>";
} else {
    echo "Error modifying categories table: " . mysqli_error($conn) . "<br>";
}

// Modify the `id` column in `users` table to be UNSIGNED and AUTO_INCREMENT
$alterUsersTableQuery = "ALTER TABLE users MODIFY id INT UNSIGNED NOT NULL AUTO_INCREMENT;";
$alterUsersTable = mysqli_query($conn, $alterUsersTableQuery);

if ($alterUsersTable) {
    echo "Users table modified successfully.<br>";
} else {
    echo "Error modifying users table: " . mysqli_error($conn) . "<br>";
}



$createTableQuery = "CREATE TABLE IF NOT EXISTS blogs (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    image VARCHAR(255) DEFAULT NULL,
    category_id INT UNSIGNED NOT NULL,
    created_by INT UNSIGNED NOT NULL,
    description TEXT,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_category_id_blog FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE CASCADE,
    CONSTRAINT FK_created_by_blog FOREIGN KEY(created_by) REFERENCES users(id) ON DELETE CASCADE
  ) ENGINE=InnoDB;";

$createTable = mysqli_query($conn, $createTableQuery);
if($createTable){
    echo "Blogs Table is created successfully" . "<br>";
}else{
    echo "Sorry Error occured:". mysqli_error($conn) . "<br>";
}

$insertQuery = "INSERT INTO categories(title,slug,description) VALUES('Web Development','web-development','Learn how to build websites and web applications using HTML, CSS, JavaScript, and more.')";
$insertQuery .= ",('Mobile Development','mobile-development','Learn how to build mobile applications for iOS and Android using Flutter, React Native, and more.')";
$insertQuery .= ",('Data Science','data-science','Learn how to analyze and visualize data using Python, R, and more.')";
$insertQuery .= ",('Machine Learning','machine-learning','Learn how to build machine learning models using Python, TensorFlow, and more.')";
$insertQuery .= ",('Artificial Intelligence','artificial-intelligence','Learn how to build AI applications using Python, TensorFlow, and more.')";
$insertQuery .= ",('Cloud Computing','cloud-computing','Learn how to build cloud applications using AWS, Azure, and more.')";
$insertQuery .= ",('Cyber Security','cyber-security','Learn how to secure applications and networks from cyber threats using ethical hacking, penetration testing, and more.')";
$insertQuery .= ",('DevOps','devops','Learn how to automate the software development process using CI/CD, Docker, Kubernetes, and more.')";
$insertQuery .= ",('Game Development','game-development','Learn how to build games using Unity, Unreal Engine, and more.')";
$insertQuery .= ",('Digital Marketing','digital-marketing','Learn how to market products and services online using SEO, SEM, SMM, and more.')";
$insertQuery .= ",('UI/UX Design','ui-ux-design','Learn how to design user interfaces and user experiences using Figma, Adobe XD, and more.')";
$insertQuery .= ",('Blockchain','blockchain','Learn how to build blockchain applications using Ethereum, Solidity, and more.')";
$insertQuery .= ",('Internet of Things','iot','Learn how to build IoT applications using Arduino, Raspberry Pi, and more.')";
$insertQuery .= ",('Virtual Reality','vr','Learn how to build VR applications using Unity, Unreal Engine, and more.')";
$insertQuery .= ",('Augmented Reality','ar','Learn how to build AR applications using Unity, Unreal Engine, and more.')";
$insertQuery .= ",('Software Testing','software-testing','Learn how to test software applications using Selenium, JUnit, and more.')";
$insertQuery .= ",('Project Management','project-management','Learn how to manage software projects using Agile, Scrum, and more.')";
$insertQuery .= ",('Business Analysis','business-analysis','Learn how to analyze business requirements and processes using UML, BPMN, and more.')";
$insertQuery .= ",('Entrepreneurship','entrepreneurship','Learn how to start and run a successful business using Lean Startup, Business Model Canvas, and more.')";
$insertQuery .= ",('Soft Skills','soft-skills','Learn how to improve your communication, teamwork, and leadership skills using various techniques and tools.')";
$insertQuery .= ",('Public Speaking','public-speaking','Learn how to improve your public speaking skills using various techniques and tools.')";
$insertQuery .= ",('Time Management','time-management','Learn how to manage your time effectively using various techniques and tools.')";
$insertQuery .= ",('Stress Management','stress-management','Learn how to manage stress effectively using various techniques and tools.')";
$insertQuery .= ",('Personal Finance','personal-finance','Learn how to manage your personal finances effectively using various techniques and tools.')";


$insertQuery .= ",('Career Development','career-development','Learn how to develop your career effectively using various techniques and tools.')";
$insertQuery .= ",('Networking','networking','Learn how to build and maintain professional relationships effectively using various techniques and tools.')";   
// save data
$saveQuery = mysqli_query($conn, $insertQuery);

if ($saveQuery) {
    echo "Category Data is Inserted successfully" . "<br>";
} else {
    echo "Error " . mysqli_error($conn)    . "<br>";
}

// insert blogs
$insertQuery = "INSERT INTO blogs(title,slug,category_id,image,description,created_by,created_at) VALUES('Web Development','web-development',1,'https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg','Learn how to build websites and web applications using HTML, CSS, JavaScript, and more.',1,'2023-10-01 10:00:00')";
$insertQuery .= ",('Mobile Development','mobile-development',2,'https://source.unsplash.com/random/300×300','Learn how to build mobile applications for iOS and Android using Flutter, React Native, and more.',1,'2023-10-02 10:00:00')";
$insertQuery .= ",('Data Science','data-science',3,'https://source.unsplash.com/random/200×300','Learn how to analyze and visualize data using Python, R, and more.',1,'2023-10-03 10:00:00')";
$insertQuery .= ",('Machine Learning','machine-learning',4,'https://source.unsplash.com/random/400×300','Learn how to build machine learning models using Python, TensorFlow, and more.',1,'2023-10-04 10:00:00')";
$insertQuery .= ",('Artificial Intelligence','artificial-intelligence',5,'https://source.unsplash.com/random/300×400','Learn how to build AI applications using Python, TensorFlow, and more.',1,'2023-10-05 10:00:00')";
$insertQuery .= ",('Cloud Computing','cloud-computing',6,'https://source.unsplash.com/random/200×300','Learn how to build cloud applications using AWS, Azure, and more.',1,'2023-10-06 10:00:00')";
$insertQuery .= ",('Cyber Security','cyber-security',7,'https://source.unsplash.com/random/500×300','Learn how to secure applications and networks from cyber threats using ethical hacking, penetration testing, and more.',1,'2023-10-07 10:00:00')";


$saveQuery = mysqli_query($conn, $insertQuery);

if ($saveQuery) {
    echo "Category Data is Inserted successfully" . "<br>";
} else {
    echo "Error " . mysqli_error($conn)   . "<br>";
}