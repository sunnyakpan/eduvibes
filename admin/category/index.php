<?php
include_once "../../auth/checkAuth.php";
$user = $_SESSION['user_data'];
include_once "../../controller/Database.php";
include_once "../../controller/Category.php";

$db = new Database;
$category = new Category($db);
$categories = $category->getCategoriesWithBlogCount();

$per_page = 5;
$people2 = array_chunk($categories, $per_page);

$page = isset($_GET["page"]) ? $_GET["page"] : 1;


if ((int)$page <= count($people2) && $page > 0) {
    $currentPage = $page;
} else {
    $currentPage = 1;
}

include "../../includes/header.php";
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']
    === 'on' ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] .
    $_SERVER['REQUEST_URI'];


$baseUrl = $_SESSION['user_data']["baseUrl"];
$dashboardNavs = [
    [
        "name" => "Dashboard",
        "link" => $baseUrl . "dashboard.php"
    ],
    [
        "name" => "Categories",
        "link" => $baseUrl . "category/index.php"
    ],
    [
        "name" => "Blogs",
        "link" => $baseUrl . "blog/index.php"
    ],

    [
        "name" => "Users",
        "link" => $baseUrl . "user/index.php"
    ]
];
?>


<div class="page_content">
    <div class="page_content_wrapper">
        <h1>Categories</h1>

    </div>
    <br>
    <ul class="dashboardNav">
        <?php foreach ($dashboardNavs as $nav) { ?>

            <li>
                <a class="<?php echo $nav['link'] == $link ? 'active' : '' ?>" href="<?php echo $nav['link'] ?>"><?php echo $nav['name'] ?></a>
            </li>
        <?php } ?>

    </ul>
    <hr>

    <div class="ajax_page_wrapper2">

        <table class="ajax_table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Number Of Blogs</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tableBodyData">
                <?php if (isset($categories) && count($categories) > 0) : ?>
                    <?php $couter = 1;
                    $couter2 = 1;
                    foreach ($people2[$currentPage - 1] as  $cat) : ?>
                        <tr>
                            <td><?php echo (($currentPage - 1) * $per_page) + $couter; ?></td>
                            <td><?php echo $cat['title'] ?></td>
                            <td><?php echo $cat['blog_count'] ?></td>
                            <td>
                                <a href="<?php echo getRoute('blog_categories', ['slug' => $cat['slug']]) ?>" class="tb_btn">Edit</a>
                                <a href="<?php echo getRoute('blog_categories', ['slug' => $cat['slug']]) ?>" class="tb_btn">Delete</a>
                                <a href="<?php echo getRoute('blog_categories', ['slug' => $cat['slug']]) ?>" class="tb_btn">View</a>
                            </td>
                        </tr>
                    <?php $couter++;
                    endforeach; ?>
                   
                <?php else : ?>
                    <tr>
                        <td colspan="4"> <b style="color: darkred;">No Data Found</b></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <ul class="paginate">
                        <?php
                        if (count($people2) > 0) {
                            for ($i = 1; $i <= count($people2); $i++) {
                                if ($currentPage == $i) {
                                    echo "<li><a class='active' href='?page=$i'>" . $i . "</a></li>";
                                } else {

                                    echo "<li><a  href='?page=$i'>" . $i . "</a></li>";
                                }
                            }
                        }
                        ?>


                    </ul>
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