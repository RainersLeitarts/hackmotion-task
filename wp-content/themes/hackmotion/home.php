<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hackmotion</title>
    <?php
    wp_head();
    ?>
</head>
<body>
    <nav class="navbar">
        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Logo.png" alt="">
    </nav>
    <section class="hero-section">
        <div class="hero-text">
            <h3 class="hero-title">We have put together a swing improvement solution to help you <span>break <?php echo handle_title() ?></span></h3>
            <div class="hero-list">
                <p class="list-title">Pack includes:</p>
                <ul>
                    <li>Swing Analyzer -  HackMotion Core</li>
                    <li>Drills by coach Tyler Ferrell</li>
                    <li>Game improvement plan by HackMotion</li>
                </ul>
            </div>
            <a href="#training-section">Start Now -></a>
        </div>
        <div class="hero-images">
            <img class="first" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Improvement Graph.png" alt="">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Improvement Progress bar.png" alt="">
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Rating.png" alt="">
        </div>
    </section>
    <section id="training-section">
        <h2 class="training-section-title">The best solution for you: Impact Training Program</h2>
        <div class="training-section-content">
            <video class="training-video" controls>
                <source src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/videos/Impact-Drill.mp4" type="video/mp4">
            </video>
            <div class="video-progres-line"></div>
            <div class="training-info-accordion">
                <div class="accordion-item" data-timestamp="5">
                    <div class="accordion-item-header">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/expand-more.svg" alt="">
                        <h4 class="accordion-item-title">Static top drill</h4>
                    </div>
                    <p class="accordion-item-text">Get a feel for the optimal wrist position at Top of your swing</p>
                </div>
                <div class="accordion-item" data-timestamp="14">
                    <div class="accordion-item-header">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/expand-more.svg" alt="">
                        <h4 class="accordion-item-title">Dynamic top drill</h4>
                    </div>
                    <p class="accordion-item-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                </div>
                <div class="accordion-item" data-timestamp="24">
                    <div class="accordion-item-header">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/icons/expand-more.svg" alt="">
                        <h4 class="accordion-item-title">Top full swing challenge</h4>
                    </div>
                    <p class="accordion-item-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
                </div>
            </div>
        </div>
    </section>
    <div class="footer">
        Copyright 2023 © HackMotion | All Rights Reserved
    </div>
    <?php
    wp_footer();
    ?>
</body>
</html>