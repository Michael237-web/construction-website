<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db_connect.php';
include 'lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/construction/">
    <title>Getso Consultants - Quantity Surveyors & Cost Consultants</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/png" href="clogo.png">
</head>
<body>

    <!-- Top Info Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-info">
                <span><i class="fas fa-envelope"></i> info@constractors.com</span>
                <span><i class="fas fa-phone"></i> +254 746674121</span>
            </div>
            <div class="top-social">
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
            </div>
        </div>
    </div>

    <header>
        <div class="nav-container">
            <!-- Logo as Image -->
            <a href="./" class="logo-link">
                <img src="clogo.png" alt="Getso Consultants" class="logo-img">
            </a>
            
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>

            <nav id="mainNav">
                <ul>
                    <li><a href="./"><?php echo t('home'); ?></a></li>
                    <li><a href="company"><?php echo t('company'); ?></a></li>
                    
                    <!-- MEGA MENU: Services -->
                    <li class="mega-menu-parent">
                        <a href="services"><?php echo t('services'); ?> <i class="fas fa-chevron-down" style="font-size:10px; margin-left:5px;"></i></a>
                        
                        <div class="mega-menu">
                            <!-- Column 1: Quantity Survey -->
                            <div class="mega-col">
                                <h3><?php echo t('mm_qs'); ?></h3>
                                <ul>
                                    <?php
                                    $sql_qs = "SELECT * FROM construction_services WHERE category='qs' LIMIT 7";
                                    $res_qs = $conn->query($sql_qs);
                                    if($res_qs && $res_qs->num_rows > 0) {
                                        while($row = $res_qs->fetch_assoc()) {
                                            echo '<li><a href="service-detail/'.$row['id'].'?lang='.$lang.'">'.htmlspecialchars($row['title']).'</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                            
                            <!-- Column 2: Project Management -->
                            <div class="mega-col">
                                <h3><?php echo t('mm_pm'); ?></h3>
                                <ul>
                                    <?php
                                    $sql_pm = "SELECT * FROM construction_services WHERE category='pm' LIMIT 6";
                                    $res_pm = $conn->query($sql_pm);
                                    if($res_pm && $res_pm->num_rows > 0) {
                                        while($row = $res_pm->fetch_assoc()) {
                                            echo '<li><a href="service-detail/'.$row['id'].'?lang='.$lang.'">'.htmlspecialchars($row['title']).'</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <!-- Column 3: Evaluation & Monitoring -->
                            <div class="mega-col">
                                <h3><?php echo t('mm_em'); ?></h3>
                                <ul>
                                    <?php
                                    $sql_em = "SELECT * FROM construction_services WHERE category='em' LIMIT 5";
                                    $res_em = $conn->query($sql_em);
                                    if($res_em && $res_em->num_rows > 0) {
                                        while($row = $res_em->fetch_assoc()) {
                                            echo '<li><a href="service-detail/'.$row['id'].'?lang='.$lang.'">'.htmlspecialchars($row['title']).'</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>

                            <!-- Column 4: Dispute Resolution -->
                            <div class="mega-col">
                                <h3><?php echo t('mm_dr'); ?></h3>
                                <ul>
                                    <?php
                                    $sql_dr = "SELECT * FROM construction_services WHERE category='dr' LIMIT 5";
                                    $res_dr = $conn->query($sql_dr);
                                    if($res_dr && $res_dr->num_rows > 0) {
                                        while($row = $res_dr->fetch_assoc()) {
                                            echo '<li><a href="service-detail/'.$row['id'].'?lang='.$lang.'">'.htmlspecialchars($row['title']).'</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    
                    <li><a href="portfolio"><?php echo t('portfolio'); ?></a></li>
                    <li><a href="resources"><?php echo t('resources'); ?></a></li>
                    <li><a href="team"><?php echo t('team'); ?></a></li>
                    <li><a href="contact"><?php echo t('contact'); ?></a></li>
                    
                    <!-- Categories Dropdown (Dynamic from Database) -->
                    <li class="lang-switch" style="border-left: 1px solid var(--border); padding-left: 15px; margin-left: 15px;">
                        <button class="lang-btn">
                            <i class="fas fa-list"></i> Categories <i class="fas fa-chevron-down" style="font-size:10px; margin-left:5px;"></i>
                        </button>
                        <div class="lang-dropdown" style="min-width: 260px; max-height: 400px; overflow-y: auto;">
                            <?php
                            $cat_sql = "SELECT category, COUNT(*) as count 
                                        FROM construction_posts 
                                        WHERE category IS NOT NULL AND category != '' 
                                        GROUP BY category 
                                        ORDER BY category ASC";
                            $cat_result = $conn->query($cat_sql);
                            if ($cat_result && $cat_result->num_rows > 0) {
                                while ($cat_row = $cat_result->fetch_assoc()) {
                                    $cat_name = $cat_row['category'];
                                    $cat_count = $cat_row['count'];
                                    echo '<a href="category?cat=' . urlencode($cat_name) . '&amp;lang=' . $lang . '" style="display: flex; justify-content: space-between; align-items: center;">';
                                    echo '<span>' . htmlspecialchars($cat_name) . '</span>';
                                    echo '<span style="background:#f0f0f0; color:#666; padding:2px 8px; border-radius:30px; font-size:10px; font-weight:700;">' . $cat_count . '</span>';
                                    echo '</a>';
                                }
                            }
                            ?>
                            <a href="resources" style="text-align: center; font-weight: bold; color: var(--primary); display: block; border-top: 1px solid #eee; margin-top: 5px; padding-top: 12px;"><?php echo t('view_all'); ?> &rarr;</a>
                        </div>
                    </li>

                    <!-- Language Changer (preserves all other URL params) -->
                    <li class="lang-switch">
                        <button class="lang-btn">
                            <i class="fas fa-globe"></i> <?php echo strtoupper($lang); ?>
                        </button>
                        <div class="lang-dropdown">
                            <?php
                            $params = $_GET;
                            unset($params['lang']);
                            $base_qs = http_build_query($params);
                            $lang_prefix = !empty($base_qs) ? $base_qs . '&lang=' : 'lang=';
                            ?>
                            <a href="?<?php echo $lang_prefix; ?>en">🇺🇸 English</a>
                            <a href="?<?php echo $lang_prefix; ?>fr">🇫🇷 Français</a>
                            <a href="?<?php echo $lang_prefix; ?>es">🇪🇸 Español</a>
                            <a href="?<?php echo $lang_prefix; ?>de">🇩🇪 Deutsch</a>
                            <a href="?<?php echo $lang_prefix; ?>sw">🇰🇪 Kiswahili</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
    </header>