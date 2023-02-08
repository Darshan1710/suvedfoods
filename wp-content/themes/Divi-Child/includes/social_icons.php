
<ul class="et-social-icons">

<li class="et-social-icon et-social-linkedin">
    <a href="https://linkedin.com/yourprofileurl/‎" class="icon">
        <span><?php esc_html_e( 'LinkedIn', 'Divi' ); ?></span>
    </a>
</li>	
<li class="et-social-icon et-social-youtube">
    <a href="https://linkedin.com/yourprofileurl/‎" class="icon">
        <span><?php esc_html_e( 'Youtube', 'Divi' ); ?></span>
    </a>
</li>	
<?php if ( 'on' === et_get_option( 'divi_show_linkedin_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-linkedin">
		<a href="<?php echo esc_url( et_get_option( 'divi_linkedin_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( 'Linkedin', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>
<?php if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) : ?>
	<li class="et-social-icon et-social-twitter">
		<a href="<?php echo esc_url( et_get_option( 'divi_twitter_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( 'Twitter', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>
	
<?php $et_instagram_default = ( true === et_divi_is_fresh_install() ) ? 'on' : 'false'; ?>
<?php if ( 'on' === et_get_option( 'divi_show_instagram_icon', $et_instagram_default ) ) : ?>
	<li class="et-social-icon et-social-instagram">
		<a href="<?php echo esc_url( et_get_option( 'divi_instagram_url', '#' ) ); ?>" class="icon">
			<span><?php esc_html_e( 'Instagram', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>
<?php if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) : ?>
<?php
	$et_rss_url = '' !== et_get_option( 'divi_rss_url' )
		? et_get_option( 'divi_rss_url' )
		: get_bloginfo( 'rss2_url' );
?>
	<li class="et-social-icon et-social-rss">
		<a href="<?php echo esc_url( $et_rss_url ); ?>" class="icon">
			<span><?php esc_html_e( 'RSS', 'Divi' ); ?></span>
		</a>
	</li>
<?php endif; ?>

</ul>