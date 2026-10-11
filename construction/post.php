<?php
include 'header.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM construction_posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        
        // Use helper functions for localized content
        $title = get_localized_field($post, 'title');
        $content = get_localized_field($post, 'content');
        $category = get_localized_field($post, 'category');
        
        $post_date = isset($post['created_at']) ? date('F d, Y', strtotime($post['created_at'])) : 'Recent';
        $post_image = !empty($post['image']) ? $post['image'] : 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=1200&q=80';
        ?>
        
        <!-- Post Hero -->
        <div style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('<?php echo htmlspecialchars($post_image); ?>'); background-size: cover; background-position: center; padding: 120px 20px 60px; text-align: center; color: #fff; margin-top: 70px;">
            <div style="max-width: 800px; margin: 0 auto;">
                <span style="background: var(--primary); padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                    <?php echo htmlspecialchars($category); ?>
                </span>
                <h1 style="font-size: 2.5rem; margin: 20px 0 10px;"><?php echo htmlspecialchars($title); ?></h1>
                <p style="opacity: 0.8;"><i class="far fa-calendar-alt"></i> <?php echo $post_date; ?></p>
            </div>
        </div>

        <!-- Post Content -->
        <section class="section" style="max-width: 800px; background: #fff; margin-top: -30px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); position: relative; z-index: 10;">
            <div style="font-size: 1.1rem; line-height: 1.8; color: #444;">
                <?php echo nl2br(htmlspecialchars_decode($content)); ?>
            </div>
            
            <div style="margin-top: 40px; border-top: 1px solid #eee; padding-top: 20px;">
                <a href="resources.php" class="btn-back">
                    <i class="fas fa-arrow-left"></i> <?php echo t('resources'); ?>
                </a>
            </div>
        </section>

        <?php
    } else {
        echo "<section class='section' style='margin-top: 100px;'><h2>Article not found.</h2></section>";
    }
    $stmt->close();
} else {
    echo "<section class='section' style='margin-top: 100px;'><h2>Invalid Request.</h2></section>";
}

include 'footer.php';
?>