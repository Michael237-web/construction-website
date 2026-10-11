<?php 
include 'header.php'; 

$message_sent = false;
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO construction_contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        
        if ($stmt->execute()) {
            $message_sent = true;
        } else {
            $error_msg = "Something went wrong. Please try again later.";
        }
        $stmt->close();
    } else {
        $error_msg = "Please fill in all fields.";
    }
}
?>

<!-- ============================================
     CONTACT HERO
     ============================================ -->
<section class="contact-hero" style="background-image: linear-gradient(rgba(0,0,0,0.75), rgba(0,0,0,0.75)), url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80');">
    <div class="contact-hero-content">
        <span class="article-tag" style="background: var(--primary);"><?php echo t('contact_us'); ?></span>
        <h1><?php echo t('contact_us'); ?></h1>
        <p><?php echo t('contact_sub'); ?></p>
    </div>
</section>

<!-- ============================================
     CONTACT INFO CARDS
     ============================================ -->
<section class="section" style="margin-top: 60px;">
    <div class="contact-info-grid">

        <div class="contact-info-card">
            <div class="contact-info-icon" style="background: #f39c12;">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <h3><?php echo t('location'); ?></h3>
            <p>Upper Hill, Nairobi, Kenya</p>
        </div>

        <div class="contact-info-card">
            <div class="contact-info-icon" style="background: #2980b9;">
                <i class="fas fa-envelope"></i>
            </div>
            <h3>Email</h3>
            <p>info@constractors.com</p>
        </div>

        <div class="contact-info-card">
            <div class="contact-info-icon" style="background: #27ae60;">
                <i class="fas fa-phone"></i>
            </div>
            <h3><?php echo t('phone'); ?></h3>
            <p>+254 746674121</p>
        </div>

        <div class="contact-info-card">
            <div class="contact-info-icon" style="background: #8e44ad;">
                <i class="fas fa-clock"></i>
            </div>
            <h3>Working Hours</h3>
            <p>Mon – Fri, 8:00 AM – 5:00 PM</p>
        </div>

    </div>
</section>

<!-- ============================================
     CONTACT FORM + MAP
     ============================================ -->
<section class="section">
    <div class="contact-main-grid">

        <!-- Contact Form -->
        <div class="contact-form-wrap">
            <h2 class="section-title"><?php echo t('send_msg'); ?></h2>
            <p style="margin-bottom: 25px; color: #666; font-size: 14.5px;">
                Fill in the form below and a member of our team will get back to you within 24 hours.
            </p>

            <?php if($message_sent): ?>
                <div class="contact-notice contact-notice-success">
                    <i class="fas fa-check-circle"></i> <?php echo t('msg_sent'); ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($error_msg)): ?>
                <div class="contact-notice contact-notice-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="contact-form">
                <div class="form-row">
                    <div class="form-group">
                        <label><?php echo t('form_name'); ?></label>
                        <input type="text" name="name" required placeholder="e.g. John Doe">
                    </div>
                    <div class="form-group">
                        <label><?php echo t('form_email'); ?></label>
                        <input type="email" name="email" required placeholder="you@example.com">
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo t('form_msg'); ?></label>
                    <textarea name="message" rows="6" required placeholder="Tell us about your project..."></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                    <i class="fas fa-paper-plane"></i> <?php echo t('send_msg'); ?>
                </button>
            </form>
        </div>

        <!-- Google Map -->
        <div class="contact-map-wrap">
            <h2 class="section-title"><?php echo t('location'); ?></h2>
            <div class="contact-map">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.8055637100697!2d36.81073531526545!3d-1.2967019990565718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f1172c8abcf05%3A0x3e3d1b3e0f89b5d9!2sUpper%20Hill%2C%20Nairobi!5e0!3m2!1sen!2ske!4v1700000000000" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</section>

<!-- ============================================
     CALL TO ACTION
     ============================================ -->
<section class="service-cta" style="background: linear-gradient(135deg, var(--dark), #1a252f);">
    <div class="service-cta-inner">
        <h2>Ready to Start Your Project?</h2>
        <p>Our team of experts is ready to bring your vision to life. Get in touch today for a free consultation.</p>
        <a href="services.php" class="btn-primary">
            <i class="fas fa-th-large"></i> Explore Our Services
        </a>
    </div>
</section>

<?php include 'footer.php'; ?>