<?php
include 'header.php';
?>

    <!-- Hero Slideshow Section -->
    <section class="hero-slider">
        <div class="slide active anim-top" style="background-image: url('https://scmachinery.ru/upload/iblock/19d/kv2c9ghn2laht6ocuvyy1rkyeby1o4kb.jpg');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-right" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-bottom" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-left" style="background-image: url('https://koala.sh/api/image/v2-pjbkq-d7fv2.jpg?dream=&height=832&width=1216');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-zoom" style="background-image: url('https://images.squarespace-cdn.com/content/v1/62be48c129579b663baeb082/9d37ba1e-c5aa-4bf2-a1cb-c0ebd08417f8/IMG_7217%2B%281%29.jpeg');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-rotate" style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-top" style="background-image: url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1600&q=80');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slide anim-right" style="background-image: url('https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?auto=format&fit=crop&w=1600&q=80');">
            <div class="slide-overlay">
                <h1><?php echo t('hero_title'); ?></h1>
                <p><?php echo t('hero_sub'); ?></p>
            </div>
        </div>
        
        <div class="slider-dots">
            <span class="dot active" onclick="currentSlide(0)"></span>
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            <span class="dot" onclick="currentSlide(4)"></span>
            <span class="dot" onclick="currentSlide(5)"></span>
            <span class="dot" onclick="currentSlide(6)"></span>
            <span class="dot" onclick="currentSlide(7)"></span>
        </div>
    </section>

    <!-- Related Articles Section -->
    <section class="section">
        <h2 class="section-title"><?php echo t('related_articles'); ?></h2>
        <div class="articles-grid">
            
            <?php
            $title_col = get_lang_column('title');
            $content_col = get_lang_column('content');
            $category_col = get_lang_column('category');

            $sql = "SELECT id, created_at, image,
                           COALESCE($title_col, title) AS display_title,
                           COALESCE($content_col, content) AS display_content,
                           COALESCE($category_col, category) AS display_category
                    FROM construction_posts 
                    ORDER BY id DESC LIMIT 4";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $post_date = isset($row['created_at']) ? date('M d, Y', strtotime($row['created_at'])) : 'Recent';
                    $post_image = !empty($row['image']) ? $row['image'] : 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=600&q=80';
                    $post_category = !empty($row['display_category']) ? $row['display_category'] : 'Construction';
                    $post_desc = !empty($row['display_content']) ? substr(strip_tags($row['display_content']), 0, 100) . '...' : 'Click to read more...';
                    ?>
                    
                    <div class="article-card">
                        <img src="<?php echo htmlspecialchars($post_image); ?>" alt="<?php echo htmlspecialchars($row['display_title']); ?>" class="article-img">
                        <div class="article-body">
                            <span class="article-tag"><?php echo htmlspecialchars($post_category); ?></span>
                            <h3 class="article-title"><?php echo htmlspecialchars($row['display_title']); ?></h3>
                            <p class="article-desc"><?php echo $post_desc; ?></p>
                            <div class="article-footer">
                                <span><?php echo $post_date; ?></span>
                                <a href="post.php?id=<?php echo $row['id']; ?>" class="read-more"><?php echo t('read_more'); ?> &rarr;</a>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                }
            } else {
                echo "<p>No articles found in the database.</p>";
            }
            ?>

        </div>
    </section>

<?php
include 'footer.php';
?>