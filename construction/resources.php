<?php include 'header.php'; ?>

<!-- ============================================
     RESOURCES HERO SLIDESHOW
     ============================================ -->
<section class="resources-hero-slider">
    <div class="resources-slide active anim-top" style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('knowledge_hub'); ?></h1>
            <p><?php echo t('knowledge_sub'); ?></p>
        </div>
    </div>

    <div class="resources-slide anim-right" style="background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('knowledge_hub'); ?></h1>
            <p><?php echo t('knowledge_sub'); ?></p>
        </div>
    </div>

    <div class="resources-slide anim-bottom" style="background-image: url('https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('knowledge_hub'); ?></h1>
            <p><?php echo t('knowledge_sub'); ?></p>
        </div>
    </div>

    <div class="resources-slide anim-zoom" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('knowledge_hub'); ?></h1>
            <p><?php echo t('knowledge_sub'); ?></p>
        </div>
    </div>
</section>

<!-- ============================================
     RESOURCES GRID WITH FILTER
     ============================================ -->
<section class="section" style="padding-top: 60px;">
    <h2 class="section-title"><?php echo t('knowledge_hub'); ?></h2>
    <p style="margin-bottom: 30px; color: #666; max-width: 800px;">
        <?php echo t('knowledge_sub'); ?>
    </p>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <button class="filter-btn active" data-filter="all">All</button>
        <button class="filter-btn" data-filter="Quantity Surveying">Quantity Surveying</button>
        <button class="filter-btn" data-filter="Cost Management">Cost Management</button>
        <button class="filter-btn" data-filter="Project Management">Project Management</button>
        <button class="filter-btn" data-filter="Contracts & Legal">Contracts &amp; Legal</button>
        <button class="filter-btn" data-filter="Dispute Resolution">Dispute Resolution</button>
        <button class="filter-btn" data-filter="Materials">Materials</button>
        <button class="filter-btn" data-filter="Sustainability">Sustainability</button>
        <button class="filter-btn" data-filter="Infrastructure">Infrastructure</button>
        <button class="filter-btn" data-filter="Safety">Safety</button>
        <button class="filter-btn" data-filter="Technology">Technology</button>
        <button class="filter-btn" data-filter="Finance">Finance</button>
        <button class="filter-btn" data-filter="Industry Trends">Trends</button>
        <button class="filter-btn" data-filter="Case Study">Case Studies</button>
    </div>

    <div class="articles-grid" id="resourcesGrid">
        <?php
        $title_col = get_lang_column('title');
        $content_col = get_lang_column('content');
        $category_col = get_lang_column('category');

        $sql = "SELECT id, created_at, image, category,
                       COALESCE($title_col, title) AS display_title,
                       COALESCE($content_col, content) AS display_content,
                       COALESCE($category_col, category) AS display_category
                FROM construction_posts 
                ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $post_date = isset($row['created_at']) ? date('M d, Y', strtotime($row['created_at'])) : 'Recent';
                $post_image = !empty($row['image']) ? $row['image'] : 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=600&q=80';
                $post_cat = !empty($row['display_category']) ? $row['display_category'] : 'General';
                // The filter still uses the original English category for JS matching
                $filter_cat = !empty($row['category']) ? $row['category'] : 'General';
                ?>
                <div class="article-card resource-card" data-category="<?php echo htmlspecialchars($filter_cat); ?>">
                    <img src="<?php echo htmlspecialchars($post_image); ?>" alt="<?php echo htmlspecialchars($row['display_title']); ?>" class="article-img">
                    <div class="article-body">
                        <span class="article-tag"><?php echo htmlspecialchars($post_cat); ?></span>
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
            echo "<p>" . t('no_articles') . "</p>";
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>