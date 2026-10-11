<?php include 'header.php'; ?>

<section class="section" style="margin-top: 100px;">
    <h2 class="section-title"><?php echo t('our_portfolio'); ?></h2>
    <p style="margin-bottom: 40px; color: #666;"><?php echo t('portfolio_sub'); ?></p>
    
    <div class="articles-grid">
        <?php
        $sql = "SELECT * FROM construction_projects ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                ?>
                <div class="article-card">
                    <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" class="article-img">
                    <div class="article-body">
                        <span class="article-tag"><?php echo htmlspecialchars($row['category']); ?></span>
                        <h3 class="article-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p class="article-desc"><?php echo htmlspecialchars($row['description']); ?></p>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>" . t('no_projects') . "</p>";
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>