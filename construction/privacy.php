<?php include 'header.php'; ?>

<!-- Page Hero -->
<section class="legal-hero" style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1600&q=80');">
    <div class="legal-hero-content">
        <span class="article-tag" style="background: var(--primary);">Legal</span>
        <h1><?php echo t('privacy_title'); ?></h1>
        <p><?php echo t('privacy_sub'); ?></p>
    </div>
</section>

<!-- Content -->
<section class="section" style="max-width: 900px;">
    <p style="color: #999; font-size: 13px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 30px;">
        <i class="fas fa-calendar-alt"></i> <?php echo t('privacy_last_updated'); ?>: <?php echo date('F d, Y'); ?>
    </p>

    <div class="legal-content">
        <p class="legal-intro"><?php echo t('privacy_intro'); ?></p>

        <h2><?php echo t('privacy_section1_title'); ?></h2>
        <p><?php echo t('privacy_section1_desc'); ?></p>

        <h2><?php echo t('privacy_section2_title'); ?></h2>
        <p><?php echo t('privacy_section2_desc'); ?></p>

        <h2><?php echo t('privacy_section3_title'); ?></h2>
        <p><?php echo t('privacy_section3_desc'); ?></p>

        <h2><?php echo t('privacy_section4_title'); ?></h2>
        <p><?php echo t('privacy_section4_desc'); ?></p>

        <h2><?php echo t('privacy_section5_title'); ?></h2>
        <p><?php echo t('privacy_section5_desc'); ?></p>

        <h2><?php echo t('privacy_section6_title'); ?></h2>
        <p><?php echo t('privacy_section6_desc'); ?></p>
    </div>

    <div style="margin-top: 40px; padding-top: 30px; border-top: 1px solid #eee;">
        <a href="index.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> <?php echo t('home'); ?>
        </a>
    </div>
</section>

<?php include 'footer.php'; ?>