<?php
include "../includes/header.php";
include "../controller/Database.php";
include "../controller/Blog.php";

include "../controller/Category.php";
$db = new Database();
$blog = new Blog($db);
$category = new Category($db);
$id = $_GET['id'] ?? null;
if ($id) {
    $post = $blog->getBlogById($id);
    if (!$post) {
        header("Location: " . getRoute('home'));
        exit;
    }
}
?>
<section class="blog_details">

    <div class="wrap">
        
        <div class="posts">
            <div class="post mb-5">
                <div class="section">
                    <img src="<?php echo $post["image"]; ?>" alt="">
                    <h1><?php echo $post["title"]; ?></h1>
                    
                    <p class="description"><?php echo $post["description"]; ?></p>
                    <span  class="readmore">Posted on <?php echo date("F j, Y", strtotime($post["created_at"])); ?></span>
                </div>
            </div>
            
        </div>

    </div>
</section>





<?php
include "../includes/footer.php";
?>
</body>

</html>