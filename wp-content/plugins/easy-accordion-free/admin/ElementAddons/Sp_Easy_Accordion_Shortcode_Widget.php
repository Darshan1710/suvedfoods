<?php

/**
 * Elementor easy accordion free shortcode Widget.
 *
 * @since 2.1.6
 */
class Sp_Easy_Accordion_Shortcode_Widget extends \Elementor\Widget_Base {
	/**
	 * Get widget name.
	 *
	 * @since 2.1.6
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'sp_easy_accordion_free_shortcode';
	}

	/**
	 * Get widget title.
	 *
	 * @since 2.1.6
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Easy Accordion', 'easy-accordion-free' );
	}

	/**
	 * Get widget icon.
	 *
	 * @since 2.1.6
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'icon-accordion-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * @since 2.1.6
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'basic' );
	}

	/**
	 * Get all post list.
	 *
	 * @since 2.1.6
	 * @return array
	 */
	public function sp_wcsp_post_list() {
		$post_list     = array();
		$sp_wcsp_posts = new \WP_Query(
			array(
				'post_type'      => 'sp_easy_accordion',
				'post_status'    => 'publish',
				'posts_per_page' => 10000,
			)
		);
		$posts         = $sp_wcsp_posts->posts;
		foreach ( $posts as $post ) {
			$post_list[ $post->ID ] = $post->post_title;
		}
		krsort( $post_list );
		return $post_list;
	}

	/**
	 * Controls register.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'easy-accordion-free' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'sp_easy_accordion_free_shortcode',
			array(
				'label'       => __( 'Easy Accordion Shortcode(s)', 'easy-accordion-free' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => '',
				'options'     => $this->sp_wcsp_post_list(),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render woo category slider free shortcode widget output on the frontend.
	 *
	 * @since 2.1.6
	 * @access protected
	 */
	protected function render() {

		$settings          = $this->get_settings_for_display();
		$sp_wcsp_shortcode = $settings['sp_easy_accordion_free_shortcode'];

		if ( '' === $sp_wcsp_shortcode ) {
			echo '<div style="text-align: center; margin-top: 0; padding: 10px" class="elementor-add-section-drag-title">Select a shortcode</div>';
			return;
		}

		$generator_id = $sp_wcsp_shortcode;

		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
			$post_id = $generator_id;
			// Content Accordion.
			$settings           = get_option( 'sp_eap_settings' );
			$upload_data        = get_post_meta( $post_id, 'sp_eap_upload_options', true );
			$shortcode_data     = get_post_meta( $post_id, 'sp_eap_shortcode_options', true );
			$main_section_title = get_the_title( $post_id );

			Easy_Accordion_Free_Shortcode::sp_eap_html_show( $post_id, $upload_data, $shortcode_data, $main_section_title );
			?>
			<script src="<?php echo esc_url( SP_EA_URL . 'public/assets/js/script.js' ); ?>" ></script>
			<?php
		} else {
			echo do_shortcode( '[sp_easyaccordion id="' . $generator_id . '"]' );
		}

	}

}
