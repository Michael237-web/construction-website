<?php
include 'header.php';

// =============================================================
// CATEGORY CONFIGURATION
// All text fields now reference translation keys via t()
// =============================================================
$category_config = [
    'qs' => [
        'label_key' => 'cat_qs_label',
        'accent' => '#f39c12',
        'icon' => 'fa-calculator',
        'mission_key' => 'cat_qs_mission',
        'approach_key' => 'cat_qs_approach',
        'benefits' => [
            ['icon' => 'fa-chart-pie', 'title_key' => 'benefit_full_cost', 'text_key' => 'benefit_full_cost_desc'],
            ['icon' => 'fa-file-invoice-dollar', 'title_key' => 'benefit_boqs', 'text_key' => 'benefit_boqs_desc'],
            ['icon' => 'fa-balance-scale', 'title_key' => 'benefit_fair_tender', 'text_key' => 'benefit_fair_tender_desc'],
            ['icon' => 'fa-hand-holding-usd', 'title_key' => 'benefit_value_eng', 'text_key' => 'benefit_value_eng_desc']
        ]
    ],
    'pm' => [
        'label_key' => 'cat_pm_label',
        'accent' => '#2980b9',
        'icon' => 'fa-tasks',
        'mission_key' => 'cat_pm_mission',
        'approach_key' => 'cat_pm_approach',
        'benefits' => [
            ['icon' => 'fa-users-cog', 'title_key' => 'benefit_central_coord', 'text_key' => 'benefit_central_coord_desc'],
            ['icon' => 'fa-clock', 'title_key' => 'benefit_ontime_del', 'text_key' => 'benefit_ontime_del_desc'],
            ['icon' => 'fa-shield-alt', 'title_key' => 'benefit_risk_ctrl', 'text_key' => 'benefit_risk_ctrl_desc'],
            ['icon' => 'fa-chart-line', 'title_key' => 'benefit_prog_report', 'text_key' => 'benefit_prog_report_desc']
        ]
    ],
    'em' => [
        'label_key' => 'cat_em_label',
        'accent' => '#27ae60',
        'icon' => 'fa-chart-bar',
        'mission_key' => 'cat_em_mission',
        'approach_key' => 'cat_em_approach',
        'benefits' => [
            ['icon' => 'fa-user-shield', 'title_key' => 'benefit_indep_verif', 'text_key' => 'benefit_indep_verif_desc'],
            ['icon' => 'fa-file-signature', 'title_key' => 'benefit_cert_draw', 'text_key' => 'benefit_cert_draw_desc'],
            ['icon' => 'fa-search-dollar', 'title_key' => 'benefit_cost_audit', 'text_key' => 'benefit_cost_audit_desc'],
            ['icon' => 'fa-exclamation-triangle', 'title_key' => 'benefit_early_warn', 'text_key' => 'benefit_early_warn_desc']
        ]
    ],
    'dr' => [
        'label_key' => 'cat_dr_label',
        'accent' => '#c0392b',
        'icon' => 'fa-gavel',
        'mission_key' => 'cat_dr_mission',
        'approach_key' => 'cat_dr_approach',
        'benefits' => [
            ['icon' => 'fa-file-contract', 'title_key' => 'benefit_robust_claim', 'text_key' => 'benefit_robust_claim_desc'],
            ['icon' => 'fa-handshake', 'title_key' => 'benefit_neg_settle', 'text_key' => 'benefit_neg_settle_desc'],
            ['icon' => 'fa-balance-scale', 'title_key' => 'benefit_contract_int', 'text_key' => 'benefit_contract_int_desc'],
            ['icon' => 'fa-shield-alt', 'title_key' => 'benefit_dispute_prev', 'text_key' => 'benefit_dispute_prev_desc']
        ]
    ],
    'gen' => [
        'label_key' => 'cat_gen_label',
        'accent' => '#8e44ad',
        'icon' => 'fa-tools',
        'mission_key' => 'cat_gen_mission',
        'approach_key' => 'cat_gen_approach',
        'benefits' => [
            ['icon' => 'fa-hard-hat', 'title_key' => 'benefit_cert_trades', 'text_key' => 'benefit_cert_trades_desc'],
            ['icon' => 'fa-check-double', 'title_key' => 'benefit_qual_guar', 'text_key' => 'benefit_qual_guar_desc'],
            ['icon' => 'fa-clock', 'title_key' => 'benefit_ontime_comp', 'text_key' => 'benefit_ontime_comp_desc'],
            ['icon' => 'fa-tools', 'title_key' => 'benefit_full_serv', 'text_key' => 'benefit_full_serv_desc']
        ]
    ]
];

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $service_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM construction_services WHERE id = ?");
    $stmt->bind_param("i", $service_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $service = $result->fetch_assoc();

        $title = get_localized_field($service, 'title');
        $desc = get_localized_field($service, 'description');

        // Hero banner uses its own dedicated image
        $hero_image = !empty($service['hero_image']) ? $service['hero_image'] : 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80';

        // Overview text with fallbacks
        $overview = !empty($service['overview']) ? $service['overview'] : $desc;
        $feature1 = !empty($service['feature1']) ? $service['feature1'] : 'Professional consulting expertise';
        $feature2 = !empty($service['feature2']) ? $service['feature2'] : 'Transparent reporting and communication';
        $feature3 = !empty($service['feature3']) ? $service['feature3'] : 'Tailored solutions for your project';
        $process_text = !empty($service['process_text']) ? $service['process_text'] : t('cta_ready');

        // Mini-slider images with fallbacks
        $slide1 = !empty($service['slide1']) ? $service['slide1'] : 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?auto=format&fit=crop&w=800&q=80';
        $slide2 = !empty($service['slide2']) ? $service['slide2'] : 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=800&q=80';
        $slide3 = !empty($service['slide3']) ? $service['slide3'] : 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80';

        $category = $service['category'];
        $config = isset($category_config[$category]) ? $category_config[$category] : $category_config['qs'];
        ?>

        <!-- ============================================
             HERO BANNER (static)
             ============================================ -->
        <section class="service-hero" style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('<?php echo htmlspecialchars($hero_image); ?>');">
            <div class="service-hero-content">
                <span class="article-tag" style="background: <?php echo $config['accent']; ?>;">
                    <i class="fas <?php echo $config['icon']; ?>" style="margin-right: 6px;"></i>
                    <?php echo strtoupper(t($config['label_key'])); ?>
                </span>
                <h1><?php echo htmlspecialchars($title); ?></h1>
                <p class="service-hero-sub"><?php echo htmlspecialchars($desc); ?></p>
            </div>
        </section>

        <!-- ============================================
             MISSION SECTION
             ============================================ -->
        <section class="mission-section" style="border-left-color: <?php echo $config['accent']; ?>;">
            <div class="mission-inner">
                <i class="fas <?php echo $config['icon']; ?>" style="color: <?php echo $config['accent']; ?>;"></i>
                <div>
                    <h2><?php echo t('our_mission'); ?></h2>
                    <p><?php echo htmlspecialchars(t($config['mission_key'])); ?></p>
                </div>
            </div>
        </section>

        <!-- ============================================
             OVERVIEW SECTION
             ============================================ -->
        <section class="section">
            <div class="service-overview-grid">
                <div class="service-overview-text">
                    <h2 class="section-title" style="border-left-color: <?php echo $config['accent']; ?>;"><?php echo t('about_us'); ?></h2>
                    <p><?php echo htmlspecialchars($overview); ?></p>
                    <p><?php echo htmlspecialchars(t($config['approach_key'])); ?></p>
                    <ul class="service-bullets">
                        <li><i class="fas fa-check-circle" style="color: <?php echo $config['accent']; ?>;"></i> <?php echo htmlspecialchars($feature1); ?></li>
                        <li><i class="fas fa-check-circle" style="color: <?php echo $config['accent']; ?>;"></i> <?php echo htmlspecialchars($feature2); ?></li>
                        <li><i class="fas fa-check-circle" style="color: <?php echo $config['accent']; ?>;"></i> <?php echo htmlspecialchars($feature3); ?></li>
                    </ul>
                </div>
                <div class="service-overview-media">
                    <div class="mini-slider">
                        <div class="mini-slide active anim-top" style="background-image: url('<?php echo htmlspecialchars($slide1); ?>');"></div>
                        <div class="mini-slide anim-right" style="background-image: url('<?php echo htmlspecialchars($slide2); ?>');"></div>
                        <div class="mini-slide anim-bottom" style="background-image: url('<?php echo htmlspecialchars($slide3); ?>');"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================
             KEY BENEFITS GRID
             ============================================ -->
        <section class="section" style="background: #fff;">
            <h2 class="section-title" style="text-align: center; border: none;"><?php echo t('key_benefits'); ?></h2>
            <div class="benefits-grid" style="margin-top: 40px;">
                <?php foreach ($config['benefits'] as $benefit): ?>
                    <div class="benefit-card" style="border-top-color: <?php echo $config['accent']; ?>;">
                        <i class="fas <?php echo $benefit['icon']; ?>" style="color: <?php echo $config['accent']; ?>;"></i>
                        <h3><?php echo t($benefit['title_key']); ?></h3>
                        <p><?php echo t($benefit['text_key']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- ============================================
             OUR PROCESS
             ============================================ -->
        <section class="section">
            <h2 class="section-title" style="text-align: center; border: none;"><?php echo t('our_process'); ?></h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto 40px; color: #666; font-size: 15px; line-height: 1.8;">
                <?php echo htmlspecialchars($process_text); ?>
            </p>
            <div class="process-timeline">
                <div class="process-step" style="border-top-color: <?php echo $config['accent']; ?>;">
                    <div class="step-number" style="color: <?php echo $config['accent']; ?>;">01</div>
                    <h4><?php echo t('process_1_title'); ?></h4>
                    <p><?php echo t('process_1_desc'); ?></p>
                </div>
                <div class="process-step" style="border-top-color: <?php echo $config['accent']; ?>;">
                    <div class="step-number" style="color: <?php echo $config['accent']; ?>;">02</div>
                    <h4><?php echo t('process_2_title'); ?></h4>
                    <p><?php echo t('process_2_desc'); ?></p>
                </div>
                <div class="process-step" style="border-top-color: <?php echo $config['accent']; ?>;">
                    <div class="step-number" style="color: <?php echo $config['accent']; ?>;">03</div>
                    <h4><?php echo t('process_3_title'); ?></h4>
                    <p><?php echo t('process_3_desc'); ?></p>
                </div>
                <div class="process-step" style="border-top-color: <?php echo $config['accent']; ?>;">
                    <div class="step-number" style="color: <?php echo $config['accent']; ?>;">04</div>
                    <h4><?php echo t('process_4_title'); ?></h4>
                    <p><?php echo t('process_4_desc'); ?></p>
                </div>
            </div>
        </section>

        <!-- ============================================
             CALL TO ACTION
             ============================================ -->
        <section class="service-cta" style="background: linear-gradient(135deg, <?php echo $config['accent']; ?>, #1a252f);">
            <div class="service-cta-inner">
                <h2><?php echo t('contact_us'); ?></h2>
                <p><?php echo t('cta_ready'); ?></p>
                <a href="contact.php" class="btn-primary">
                    <i class="fas fa-paper-plane"></i> <?php echo t('get_quote'); ?>
                </a>
            </div>
        </section>

        <!-- ============================================
             BACK TO SERVICES
             ============================================ -->
        <section class="section" style="text-align: center; padding-top: 30px; padding-bottom: 60px;">
            <a href="services.php" class="btn-back">
                <i class="fas fa-arrow-left"></i> <?php echo t('services'); ?>
            </a>
        </section>

        <?php
    } else {
        echo "<section class='section' style='margin-top: 100px;'><h2>" . t('no_articles') . "</h2></section>";
    }
    $stmt->close();
} else {
    echo "<section class='section' style='margin-top: 100px;'><h2>Invalid Request.</h2></section>";
}

include 'footer.php';
?>