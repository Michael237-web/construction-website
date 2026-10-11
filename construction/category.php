<?php
include 'header.php';

$cat = isset($_GET['cat']) ? $_GET['cat'] : 'all';
$display_cat = ucwords(str_replace('-', ' ', $cat));

// Get counts for all categories
$all_cats_sql = "SELECT category, COUNT(*) as count 
                 FROM construction_posts 
                 WHERE category IS NOT NULL AND category != '' 
                 GROUP BY category 
                 ORDER BY category ASC";
$all_cats_result = $conn->query($all_cats_sql);
?>

<!-- ============================================
     CATEGORY HERO
     ============================================ -->
<section class="category-hero" style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80');">
    <div class="category-hero-content">
        <span class="article-tag" style="background: var(--primary);"><?php echo t('category'); ?></span>
        <h1><?php echo htmlspecialchars($display_cat); ?></h1>
        <?php
        $count_sql = "SELECT COUNT(*) as total FROM construction_posts WHERE category = ?";
        $count_stmt = $conn->prepare($count_sql);
        $count_stmt->bind_param("s", $cat);
        $count_stmt->execute();
        $count_result = $count_stmt->get_result();
        $count_row = $count_result->fetch_assoc();
        $total = $count_row['total'];
        $count_stmt->close();
        ?>
        <p><?php echo $total; ?> article<?php echo $total != 1 ? 's' : ''; ?> in this category</p>
    </div>
</section>

<!-- ============================================
     MAIN CONTENT + SIDEBAR
     ============================================ -->
<section class="section" style="padding-top: 60px;">
    <div class="category-layout">

        <!-- Main: Articles -->
        <div class="category-main">
            <h2 class="section-title">Latest Articles</h2>

            <div class="articles-grid">
                <?php
                $title_col = get_lang_column('title');
                $content_col = get_lang_column('content');
                $category_col = get_lang_column('category');

                if ($cat == 'all') {
                    $sql = "SELECT id, created_at, image, category,
                                   COALESCE($title_col, title) AS display_title,
                                   COALESCE($content_col, content) AS display_content,
                                   COALESCE($category_col, category) AS display_category
                            FROM construction_posts 
                            ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                } else {
                    $sql = "SELECT id, created_at, image, category,
                                   COALESCE($title_col, title) AS display_title,
                                   COALESCE($content_col, content) AS display_content,
                                   COALESCE($category_col, category) AS display_category
                            FROM construction_posts 
                            WHERE category = ? 
                            ORDER BY id DESC";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $cat);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $post_date = isset($row['created_at']) ? date('M d, Y', strtotime($row['created_at'])) : 'Recent';
                        $post_image = !empty($row['image']) ? $row['image'] : 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=600&q=80';
                        ?>
                        <div class="article-card">
                            <img src="<?php echo htmlspecialchars($post_image); ?>" alt="<?php echo htmlspecialchars($row['display_title']); ?>" class="article-img">
                            <div class="article-body">
                                <span class="article-tag"><?php echo htmlspecialchars($row['display_category']); ?></span>
                                <h3 class="article-title"><?php echo htmlspecialchars($row['display_title']); ?></h3>
                                <p class="article-desc"><?php echo substr(strip_tags($row['display_content']), 0, 100) . '...'; ?></p>
                                <div class="article-footer">
                                    <span><?php echo $post_date; ?></span>
                                    <a href="post.php?id=<?php echo $row['id']; ?>" class="read-more"><?php echo t('read_more'); ?> &rarr;</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="category-empty">
                        <i class="fas fa-folder-open"></i>
                        <h3><?php echo t('no_cat_articles'); ?></h3>
                        <p>Try browsing a different category or explore all our resources.</p>
                        <a href="resources.php" class="btn-primary" style="margin-top: 20px;">
                            <i class="fas fa-th-large"></i> Browse All Resources
                        </a>
                    </div>
                    <?php
                }
                $stmt->close();
                ?>
            </div>
        </div>

        <!-- Sidebar: All Categories -->
        <aside class="category-sidebar">
            <div class="sidebar-card">
                <h3 class="sidebar-title">All Categories</h3>
                <ul class="sidebar-cat-list">
                    <?php
                    if ($all_cats_result && $all_cats_result->num_rows > 0) {
                        while ($c = $all_cats_result->fetch_assoc()) {
                            $is_active = (strcasecmp($c['category'], $cat) === 0);
                            ?>
                            <li>
                                <a href="category.php?cat=<?php echo urlencode($c['category']); ?>" class="<?php echo $is_active ? 'active' : ''; ?>">
                                    <span><?php echo htmlspecialchars($c['category']); ?></span>
                                    <span class="cat-count"><?php echo $c['count']; ?></span>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="sidebar-card sidebar-cta">
                <i class="fas fa-headset"></i>
                <h3>Need Help?</h3>
                <p>Our experts are ready to assist with your construction project.</p>
                <a href="contact.php" class="btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
            </div>
        </aside>

    </div>
</section>

<?php include 'footer.php'; ?>