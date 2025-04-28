<?php
include "./includes/header.php";
include "./controller/Database.php";
include "./controller/Blog.php";

include "./controller/Category.php";

$db = new Database();
$blog = new Blog($db);
$category = new Category($db);

$categories = $category->getAllWithBlogs();
$blogs = $blog->getAll();
?>

<section class="blog_categorie">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Blog Categories</h2>
                <p>Explore our blog categories to find articles that interest you.</p>
            </div>
        </div>
        <div class="blog_cat_list">
        <div class="category-box active">
                <a href="<?php echo getRoute('blog_categories', ['slug' => 'all']) ?>">

                    All
                </a>
            </div>
            <?php foreach ($categories as $cat) : ?>
                <div class="category-box">
                    <a href="<?php echo getRoute('blog_categories', ['slug' => $cat['slug']]) ?>">
                        
                        <?php echo $cat['title'] ?>
                    </a>
                </div>
            <?php endforeach; ?>
                    
            
            
        </div>
    </div>
    <div class="main-content">
        <?php foreach ($blogs as $blog) : ?>
            <div class="blog-post">
                <img src="<?php echo $blog['image']; ?>" alt="Post 1">
                <h2><?php echo $blog['title'] ?></h2>
                <p><?php echo substr($blog['description'], 0, 150) . '...' ?></p>
                <a href="<?php echo getRoute('blog_details', ['id' => $blog['id']]) ?>">Read More</a>
            </div>
            

        <?php endforeach; ?>
      
    
    
    
    
    </div>
</section>



 

<?php
include "./includes/footer.php";
?>
</body>
</html>