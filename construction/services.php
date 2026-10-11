<?php 
/**
 * @var string $lang
 * @var mysqli $conn
 */
include 'header.php'; 
?>

<!-- Services Hero Slideshow -->
<section class="services-hero-slider">
    <div class="services-slide active anim-top" style="background-image: url('https://images.unsplash.com/photo-1541888946425-d81bb19240f5?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('services'); ?></h1>
            <p><?php echo t('hero_sub'); ?></p>
        </div>
    </div>

    <div class="services-slide anim-right" style="background-image: url('https://scmachinery.ru/upload/iblock/19d/kv2c9ghn2laht6ocuvyy1rkyeby1o4kb.jpg');">
        <div class="slide-overlay">
            <h1><?php echo t('services'); ?></h1>
            <p><?php echo t('hero_sub'); ?></p>
        </div>
    </div>

    <div class="services-slide anim-bottom" style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('services'); ?></h1>
            <p><?php echo t('hero_sub'); ?></p>
        </div>
    </div>

    <div class="services-slide anim-zoom" style="background-image: url('https://images.unsplash.com/photo-1581092160562-40aa08e78837?auto=format&fit=crop&w=1600&q=80');">
        <div class="slide-overlay">
            <h1><?php echo t('services'); ?></h1>
            <p><?php echo t('hero_sub'); ?></p>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="section" style="margin-top: 60px;">
    <h2 class="section-title"><?php echo t('services'); ?></h2>
    <p style="margin-bottom: 40px; color: #666; max-width: 800px;">
        <?php echo t('services_intro'); ?>
    </p>

    <div class="services-grid">
        <?php
        $title_col = get_lang_column('title');
        $desc_col = get_lang_column('description');

        $sql = "SELECT id, category, 
                       COALESCE($title_col, title) AS display_title, 
                       COALESCE($desc_col, description) AS display_desc 
                FROM construction_services 
                ORDER BY category, id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $title = !empty($row['display_title']) ? $row['display_title'] : 'Service';
                $desc = !empty($row['display_desc']) ? $row['display_desc'] : 'Professional consulting service.';

                $cat = $row['category'];
                switch ($cat) {
                    case 'qs':  $icon = 'fa-calculator'; $color = '#f39c12'; break;
                    case 'pm':  $icon = 'fa-tasks';      $color = '#2980b9'; break;
                    case 'em':  $icon = 'fa-chart-bar';  $color = '#27ae60'; break;
                    case 'dr':  $icon = 'fa-gavel';      $color = '#c0392b'; break;
                    case 'gen': $icon = 'fa-tools';      $color = '#8e44ad'; break;
                    default:    $icon = 'fa-hard-hat';   $color = '#f39c12'; break;
                }

                $service_url = 'service-detail.php?' . http_build_query([
                    'id' => $row['id'],
                    'lang' => $lang
                ]);

                echo '<a href="' . htmlspecialchars($service_url, ENT_QUOTES) . '" class="service-card-new">';
                ?>
                    <div class="service-icon-wrap" style="background: <?php echo $color; ?>;">
                        <i class="fas <?php echo $icon; ?>"></i>
                    </div>
                    <div class="service-card-content">
                        <span class="service-cat-tag" style="color: <?php echo $color; ?>;"><?php echo strtoupper(htmlspecialchars($cat)); ?></span>
                        <h3 class="service-card-title"><?php echo htmlspecialchars($title); ?></h3>
                        <p class="service-card-desc"><?php echo htmlspecialchars($desc); ?></p>
                        <span class="service-card-cta" style="color: <?php echo $color; ?>;">
                            <?php echo t('read_more'); ?> <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
                <?php
            }
        } else {
            echo "<p>" . t('no_articles') . "</p>";
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>