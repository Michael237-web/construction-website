<?php include 'header.php'; ?>

<!-- Page Header -->
<section class="hero" style="height: 40vh; background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80');">
    <div>
        <h1><?php echo t('company_title'); ?></h1>
        <p><?php echo t('company_sub'); ?></p>
    </div>
</section>

<!-- Intro Section (Who We Are) with Slideshow -->
<section class="section">
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px; align-items: center;">
        <div>
            <h2 class="section-title"><?php echo t('about_us'); ?></h2>
            <p style="margin-bottom: 20px; color: #555; line-height: 1.8;">
                <?php echo t('about_desc'); ?>
            </p>
            <p style="margin-bottom: 20px; color: #555; line-height: 1.8;">
                Our team combines deep technical knowledge with a practical understanding of the local market to deliver cost-effective and sustainable solutions.
            </p>
            <a href="contact.php" class="btn-primary" style="display: inline-block;"><?php echo t('contact_us'); ?></a>
        </div>
        <div class="intro-media">
            <div class="mini-slider">
                <div class="mini-slide active anim-top" style="background-image: url('https://www.jcb.com/globalassets/digizuite/68215-sv-530_110-thumbnail/Img_800x640');"></div>
                <div class="mini-slide anim-right" style="background-image: url('https://images.openai.com/static-rsc-4/xbmzOEfam3V3pte-mAR4HzornKUsDzTfNSo7jIak7NizJtJm_5sQh2GUQ5HNHEWYAYJnG5zDxXjH1zuyazhjrOjpP4m6P1AfPC5Nd-nnlLKKpA54Eff4L7PJpWs4nYLQ2lh8JVtK6WX-1M7iKyqQWaoe7ZWwQ15RGHC7YVbJD3U?purpose=inline');"></div>
                <div class="mini-slide anim-bottom" style="background-image: url('https://d1ssu070pg2v9i.cloudfront.net/pex/morrisleslie/2020/09/07135605/Manitou-MT1840.jpg');"></div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Content Cards with Synced Mini Slideshows -->
<section class="section" style="background: #fff; padding-top: 80px; padding-bottom: 80px;">

    <!-- Card 1: Image Left, Text Right -->
    <div class="detail-card">
        <div class="detail-media">
            <div class="mini-slider">
                <div class="mini-slide active anim-top" style="background-image: url('https://scmachinery.ru/upload/iblock/19d/kv2c9ghn2laht6ocuvyy1rkyeby1o4kb.jpg');"></div>
                <div class="mini-slide anim-right" style="background-image: url('https://images.unsplash.com/photo-1517089596392-fb9a9033e05b?auto=format&fit=crop&w=1600&q=80');"></div>
                <div class="mini-slide anim-bottom" style="background-image: url('https://images.squarespace-cdn.com/content/v1/62be48c129579b663baeb082/9d37ba1e-c5aa-4bf2-a1cb-c0ebd08417f8/IMG_7217%2B%281%29.jpeg');"></div>
            </div>
        </div>
        <div class="detail-text">
            <h2><?php echo t('section1_title'); ?></h2>
            <p><?php echo t('section1_desc1'); ?></p>
            <p><?php echo t('section1_desc2'); ?></p>
        </div>
    </div>

    <!-- Card 2: Text Left, Image Right -->
    <div class="detail-card reverse">
        <div class="detail-media">
            <div class="mini-slider">
                <div class="mini-slide active anim-zoom" style="background-image: url('https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="mini-slide anim-left" style="background-image: url('https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="mini-slide anim-rotate" style="background-image: url('https://www.goafricaonline.com/uploads/media/default/0003/64/64a8412fa1774-WhatsApp%20Image%202023-01-21%20at%2019.29.57.jpeg');"></div>
            </div>
        </div>
        <div class="detail-text">
            <h2><?php echo t('section2_title'); ?></h2>
            <p><?php echo t('section2_desc1'); ?></p>
            <p><?php echo t('section2_desc2'); ?></p>
        </div>
    </div>

    <!-- Card 3: Image Left, Text Right -->
    <div class="detail-card">
        <div class="detail-media">
            <div class="mini-slider">
                <div class="mini-slide active anim-top" style="background-image: url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="mini-slide anim-right" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80');"></div>
                <div class="mini-slide anim-bottom" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=800&q=80');"></div>
            </div>
        </div>
        <div class="detail-text">
            <h2><?php echo t('section3_title'); ?></h2>
            <p><?php echo t('section3_desc1'); ?></p>
            <p><?php echo t('section3_desc2'); ?></p>
        </div>
    </div>

</section>

<!-- Core Values Section -->
<section class="section">
    <h2 class="section-title" style="text-align: center; border: none;"><?php echo t('core_values'); ?></h2>
    <div class="articles-grid" style="margin-top: 40px;">
        <div class="article-card" style="text-align: center; padding: 40px 20px;">
            <i class="fas fa-balance-scale" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
            <h3 class="article-title"><?php echo t('integrity'); ?></h3>
            <p class="article-desc"><?php echo t('integrity_desc'); ?></p>
        </div>
        <div class="article-card" style="text-align: center; padding: 40px 20px;">
            <i class="fas fa-chart-line" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
            <h3 class="article-title"><?php echo t('precision'); ?></h3>
            <p class="article-desc"><?php echo t('precision_desc'); ?></p>
        </div>
        <div class="article-card" style="text-align: center; padding: 40px 20px;">
            <i class="fas fa-handshake" style="font-size: 3rem; color: var(--primary); margin-bottom: 20px;"></i>
            <h3 class="article-title"><?php echo t('commitment'); ?></h3>
            <p class="article-desc"><?php echo t('commitment_desc'); ?></p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>