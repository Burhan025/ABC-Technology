<?php
/**
 * @package WordPress
 * @subpackage ABC
 */
?>
<?php $abc_options = get_option( 'abc_options' ); ?>

	<div class="footer safety-footer">
		<div class="container">
			<div class="col-sm-6 footer-left">
                <div class="footer-logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" rel="home"><img src="https://abctechgroup.com/wp-content/uploads-abc/2023/07/logo-a.png" alt="<?php bloginfo('description'); ?>"/></a>
                </div>
                <div class="footer-tag">
                    <p><?php the_field('footer_tag'); ?></p>
                </div>
            </div>
            <div class="col-sm-6 footer-right">
                <div class="footer-cta">
                    <?php the_field('footer_cta'); ?>
                </div>
                <div class="footer-support">
                    <?php the_field('footer_support'); ?>
                </div>
            </div>
		</div>
	</div>

	<div class="footer-credit">
		<div class="container">
			<div class="col-sm-6 copyright-left">
			<p>© <?php echo date("Y"); ?> ABC Technology Group.</p>
			</div>
			<div class="col-sm-6 copyright-right">
			<p>Digital Marketing By <a href="https://thriveagency.com" target="_blank"><img src="https://abctechgroup.com/wp-content/uploads-abc/2023/07/thrive-logo.png" alt="logo" width="68" height="37"></a></p>
			</div>
		</div>
	</div>
	
	<?php wp_footer(); ?>

</body>
</html>