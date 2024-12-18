<?php
/**
 * Template Name: Safe Page
 * @package WordPress
 * @subpackage ABC
 */
get_header('safe');
 ?>

<?php while ( have_posts() ) : the_post(); ?>

<div class="landing-page-safety">

        <div class="safety-offer special-offer">
            <div class="container">
                <div class="col-sm-12 offer-tag">
                    <?php the_field('offer_detail'); ?>
                </div>
            </div>
        </div>

        <div class="hero-banner">
            <div class="container">
                <div class="col-sm-8 hero-left">
                    <h1><?php the_field('hero_title'); ?></h1>
                    <div class="hero-text">
                        <?php the_field('hero_desc'); ?>
                    </div>
                    <div class="hero-image">
                        <?php $hero_img = get_field('hero_img'); ?>
                        <img src="<?php echo $hero_img['url']; ?>" alt="<?php echo $hero_img['alt']; ?>">
                    </div>
                </div>
                <div class="col-sm-4 hero-right">
                    <div class="hero-form" id="free-quote">
                        <?php echo do_shortcode('[gravityform id="9" title="true" description="true" ajax="true" tabindex="49"]'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="safety-offer support-system">
            <div class="container">
                <div class="col-sm-12 offer-detail">
                    <h2><?php the_field('offer_heading'); ?></h2>
                    <?php the_field('offer_info'); ?>
                </div>
            </div>
        </div>

        <div class="safety-solution">
            <div class="container">
                <div class="col-sm-7 solution-text">
                    <h2><?php the_field('solution_title'); ?></h2>
                    <?php the_field('solution_desc'); ?>
                    <a href="#free-quote" class="button"><?php the_field('solution_btn'); ?></a>
                </div>
                <div class="col-sm-5 solution-image">
                    <?php $solution_img = get_field('solution_img'); ?>
                    <img src="<?php echo $solution_img['url']; ?>" alt="<?php echo $solution_img['alt']; ?>">
                </div>
            </div>
        </div>

        <div class="safety-testimonial">
            <div class="container"> 
                <h2><?php the_field('testimonial_heading'); ?></h2>        
                <?php

                // Get the repeater field values
                $testimonial_content = get_field('testimonial_content');

                // Check if there are any testimonials
                if ($testimonial_content) {
                    // Loop through each testimonial
                    foreach ($testimonial_content as $testimonial) {
                        // Get the values of subfields
                        $testimonial_text = $testimonial['testimonial_text'];
                        $client_name = $testimonial['client_name'];
                        
                        // Now, display the data
                        echo '<div class="col-sm-4 testimonial">';
                        echo '<blockquote>' . $testimonial_text . '</blockquote>';
                        echo '<p class="client-name">' . $client_name . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="safety-surveillance">
            <div class="container"> 
                <h2><?php the_field('ss_heading'); ?></h2>
                <p><?php the_field('ss_info'); ?></p>
                    <?php
                    // Get the repeater field values
                    $ss_details = get_field('ss_detail');

                    // Check if there are any ss_details
                    if ($ss_details) {
                        // Loop through each ss_detail item
                        foreach ($ss_details as $ss_detail) {
                            // Get the values of subfields
                            $ss_icon = $ss_detail['ss_icon'];
                            $ss_title = $ss_detail['ss_title'];
                            $ss_desc = $ss_detail['ss_desc'];

                            // Now, display the data
                            echo '<div class="col-sm-4 ss-infobox">';
                            
                            // Display the image
                            echo '<div class="ss-icon">';
                            if ($ss_icon) {
                                echo '<img src="' . $ss_icon['url'] . '" alt="' . $ss_icon['alt'] . '">';
                            }
                            echo '</div>';

                            // Display the title and description
                            echo '<div class="ss-detail">';
                            echo '<h3>' . $ss_title . '</h3>';
                            echo '<p>' . $ss_desc . '</p>';
                            echo '</div>';

                            echo '</div>';
                        }
                    }
                    ?>
                    <div class="lp-btn"><a href="#free-quote" class="button"><?php the_field('ss_button'); ?></a></div>
            </div>
        </div>

        <div class="safety-benefit">
            <div class="container"> 
                <h2><?php the_field('tech_benefit_heading'); ?></h2>
                <p><?php the_field('tech_benefit_info'); ?></p>
                    <?php
                    // Get the repeater field values
                    $tech_benefit_details = get_field('tech_benefit_detail');

                    // Check if there are any tech_benefit_details
                    if ($tech_benefit_details) {
                        // Loop through each tech_benefit_detail item
                        foreach ($tech_benefit_details as $tech_benefit_detail) {
                            // Get the values of subfields
                            $tech_benefit_title = $tech_benefit_detail['tech_benefit_title'];
                            $tech_benefit_desc = $tech_benefit_detail['tech_benefit_desc'];

                            // Now, display the data

                            // Display the title and description
                            echo '<div class="col-sm-4 tb-infobox">';
                            echo '<h3>' . $tech_benefit_title . '</h3>';
                            echo '<p>' . $tech_benefit_desc . '</p>';
                            echo '</div>';

                        }
                    }
                    ?>
            </div>
        </div>

        <div class="safety-cta">
            <div class="container">
                <div class="col-sm-9 cta-title">
                    <h3><?php the_field('cta_heading'); ?></h3>
                </div>
                <div class="col-sm-3 cta-btn">
                    <a href="#free-quote" class="button"><?php the_field('cta_button'); ?></a>
                </div>
            </div>
        </div>

</div>

<?php endwhile; ?>
<?php get_footer('safe'); ?>