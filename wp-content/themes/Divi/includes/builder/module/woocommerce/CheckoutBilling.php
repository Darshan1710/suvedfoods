<?php
/**
 * WooCommerce Modules: ET_Builder_Module_Woocommerce_Checkout_Billing class
 *
 * The ET_Builder_Module_Woocommerce_Checkout_Billing Class is responsible for rendering the
 * Checkout billing section using the WooCommerce template.
 *
 * @package Divi\Builder
 *
 * @since 4.14.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Class representing WooCommerce Checkout billing component.
 */
class ET_Builder_Module_Woocommerce_Checkout_Billing extends ET_Builder_Module {

	/**
	 * Initialize.
	 *
	 * @since 4.14.0 Fixed PHP Warnings {@link https://github.com/elegantthemes/Divi/issues/22104}
	 */
	public function init() {
		$this->name        = esc_html__( 'Woo Checkout Billing', 'et_builder' );
		$this->plural      = esc_html__( 'Woo Checkout Billing', 'et_builder' );
		$this->slug        = 'et_pb_wc_checkout_billing';
		$this->vb_support  = 'on';
		$this->folder_name = 'et_pb_woo_modules';

		$this->settings_modal_toggles = array(
			'advanced' => array(
				'toggles' => array(
					'layout'      => array(
						'title'    => et_builder_i18n( 'Layout' ),
						'priority' => 45,
					),
					'title'       => array(
						'title'    => esc_html__( 'Title Text', 'et_builder' ),
						'priority' => 55,
					),
					'field_label' => array(
						'title'    => esc_html__( 'Field Labels', 'et_builder' ),
						'priority' => 60,
					),
					'form_field'  => array(
						'title'    => esc_html__( 'Fields', 'et_builder' ),
						'priority' => 65,
					),
					'form_notice' => array(
						'title'    => esc_html__( 'Form Notice', 'et_builder' ),
						'priority' => 70,
					),
				),
			),
		);

		$this->advanced_fields = array(
			'fonts'        => array(
				// Use `title` in place of `header` since `header` needs a workaround in Copy/Paste.
				'title'       => array(
					'label'       => esc_html__( 'Title', 'et_builder' ),
					'css'         => array(
						'main' => '%%order_class%% h3',
					),
					'font_size'   => array(
						'default' => '22px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'title',
				),
				'field_label' => array(
					'label'       => esc_html__( 'Field Label', 'et_builder' ),
					'css'         => array(
						'main' => '%%order_class%% form .form-row label',
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'line_height' => array(
						'default' => '2em',
					),
					'toggle_slug' => 'field_label',
				),
			),
			'text'         => array(
				'use_background_layout' => false,
				'use_text_orientation'  => true,
			),
			'button'       => false,
			'link_options' => false,
			'form_field'   => array(
				'form_field'  => array(
					'label'           => esc_html__( 'Fields', 'et_builder' ),
					'css'             => array(
						'main'                         => implode(
							',',
							array(
								'.woocommerce %%order_class%% .select2-container--default .select2-selection--single',
								'.woocommerce %%order_class%% form .form-row .input-text',
							)
						),
						'background_color_hover'       => implode(
							',',
							[
								'%%order_class%% .select2-container--default .select2-selection--single:hover',
								'.woocommerce %%order_class%% form .form-row .input-text:hover',
							]
						),
						'focus_background_color'       => implode(
							',',
							[
								'.woocommerce %%order_class%% .select2-container--open .select2-selection',
								'.woocommerce %%order_class%% form .input-text:focus',
							]
						),
						'focus_background_color_hover' => implode(
							',',
							[
								'.woocommerce %%order_class%% .select2-container--open:hover .select2-selection',
								'.woocommerce %%order_class%% form .input-text:focus:hover',
							]
						),
						'focus_text_color'             => implode(
							',',
							array(
								'.woocommerce %%order_class%% .select2-container--open .select2-selection__rendered',
								'.woocommerce %%order_class%% form .form-row input.input-text:focus',
							)
						),
						'focus_text_color_hover'       => implode(
							',',
							array(
								'.woocommerce %%order_class%% .select2-container--open:hover .select2-selection__rendered',
								'.woocommerce %%order_class%% form .form-row input.input-text:focus:hover',
							)
						),
						'form_text_color'              => implode(
							',',
							array(
								'.woocommerce %%order_class%% .select2-container--default .select2-selection--single .select2-selection__rendered',
								'.woocommerce %%order_class%% form .form-row .input-text',
							)
						),
						'form_text_color_hover'        => implode(
							',',
							array(
								'.woocommerce %%order_class%% .select2-container .select2-selection--single:hover .select2-selection__rendered',
								'.woocommerce %%order_class%% form .form-row .input-text:hover',
							)
						),
					),
					'box_shadow'      => array(
						'css' => array(
							'main' => implode(
								',',
								array(
									'%%order_class%% .select2-container--default .select2-selection--single',
									'%%order_class%% form .form-row input.input-text',
								)
							),
						),
					),
					'border_styles'   => array(
						'form_field'       => array(
							'label_prefix' => esc_html__( 'Fields', 'et_builder' ),
							'css'          => array(
								'main' => array(
									'border_styles' => implode(
										',',
										array(
											'.woocommerce %%order_class%% .select2-container--default .select2-selection--single',
											'.woocommerce %%order_class%% form .form-row .input-text',
										)
									),
									'border_radii'  => implode(
										',',
										array(
											'.woocommerce %%order_class%% .select2-container--default .select2-selection--single',
											'.woocommerce %%order_class%% form .form-row input.input-text',
										)
									),
								),
							),
							'defaults'     => array(
								'border_radii'  => 'on|0px|0px|0px|0px',
								'border_styles' => array(
									'width' => '0px',
									'style' => 'solid',
								),
							),
						),
						'form_field_focus' => array(
							'label_prefix' => esc_html__( 'Fields Focus', 'et_builder' ),
							'css'          => array(
								'main' => array(
									'border_styles' => implode(
										',',
										array(
											'.woocommerce %%order_class%% .select2-container--default.select2-container--open .select2-selection--single',
											'.woocommerce %%order_class%% form .form-row .input-text:focus',
										)
									),
									'border_radii'  => implode(
										',',
										array(
											'.woocommerce %%order_class%% .select2-container--default.select2-container--open .select2-selection--single',
											'.woocommerce %%order_class%% form .form-row input.input-text:focus',
										)
									),
								),
							),
							'defaults'     => array(
								'border_radii'  => 'on|0px|0px|0px|0px',
								'border_styles' => array(
									'width' => '0px',
									'style' => 'solid',
								),
							),
						),
					),
					'font_field'      => array(
						'css'         => array(
							'main'      => implode(
								',',
								[
									'.woocommerce %%order_class%% .select2-container--default .select2-selection--single',
									'.woocommerce %%order_class%% form .form-row .input-text',
								]
							),

							// Required to override default WooCommerce styles.
							'important' => array( 'line-height', 'size', 'font' ),
						),
						'font_size'   => array(
							'default' => '14px',
						),
						'line_height' => array(
							'default' => '1.7em',
						),
					),
					'margin_padding'  => array(
						'css' => array(
							'main'    => '%%order_class%% form .form-row input.input-text, %%order_class%% .select2-container--default .select2-selection--single .select2-selection__rendered',
							'padding' => '%%order_class%% form .form-row input.input-text, %%order_class%% .select2-container--default .select2-selection--single',
							'margin'  => '%%order_class%% form .form-row input.input-text, %%order_class%% .select2-container--default .select2-selection--single',
						),
					),
					'width'           => array(),
					'toggle_priority' => 55,
				),
				'form_notice' => array(
					'label'                  => esc_html__( 'Form Notice', 'et_builder' ),
					'css'                    => array(
						'form_text_color'  => '%%order_class%% .woocommerce-error li',
						'background_color' => '%%order_class%% .woocommerce-error',
						'important'        => array( 'background_color' ),
					),
					'background_color'       => array(
						'description' => esc_html__( 'Pick a color to fill the module\'s notice.', 'et_builder' ),
					),
					'text_color'             => array(
						'description' => esc_html__( 'Pick a color to be used for the text written inside notice.', 'et_builder' ),
					),
					'focus_background_color' => false,
					'focus_text_color'       => false,
					'font_field'             => array(
						'css'         => array(
							'main'        => '%%order_class%% .woocommerce-NoticeGroup .woocommerce-error',
							'important'   => array( 'text-shadow', 'size' ),
							'text_shadow' => '%%order_class%% .woocommerce-NoticeGroup .woocommerce-error',
						),
						'font_size'   => array(
							'default' => '18px',
						),
						'line_height' => array(
							'default' => '1.7em',
						),
					),
					'margin_padding'         => array(
						'css'            => array(
							'main'      => '%%order_class%% .woocommerce-error',
							'important' => array( 'custom_padding' ),
						),
						'custom_padding' => array(
							'default' => '15px|15px|15px|15px|false|false',
						),
					),
					'border_styles'          => array(
						'form_notice' => array(
							'label_prefix'      => esc_html__( 'Form Notice', 'et_builder' ),
							'css'               => array(
								'main'      => array(
									'border_styles' => '%%order_class%% .woocommerce-error',
									'border_radii'  => '%%order_class%% .woocommerce-error',
								),
								'important' => true,
							),
							'defaults'          => array(
								'border_radii'  => 'on|0px|0px|0px|0px',
								'border_styles' => array(
									'width' => '0px',
									'style' => 'solid',
								),
							),
							'use_focus_borders' => false,
						),
					),
					'box_shadow'             => array(
						'css' => array(
							'main'      => '%%order_class%% .woocommerce-error',
							'important' => true,
						),
					),
				),
			),
		);

		$this->custom_css_fields = array(
			'title_text'  => array(
				'label'    => esc_html__( 'Title Text', 'et_builder' ),
				'selector' => '%%order_class%% h3',
			),
			'field_label' => array(
				'label'    => esc_html__( 'Field Label', 'et_builder' ),
				'selector' => '%%order_class%% form .form-row label',
			),
			'form_field'  => array(
				'label'    => esc_html__( 'Fields', 'et_builder' ),
				'selector' => implode(
					',',
					array(
						'%%order_class%% .select2-container--default .select2-selection--single',
						'%%order_class%% form .form-row .input-text',
					)
				),
			),
			'form_notice' => array(
				'label'    => esc_html__( 'Form Notice', 'et_builder' ),
				'selector' => '%%order_class%% .woocommerce-error',
			),
		);

		$this->help_videos = array(
			array(
				'id'   => esc_html( '7X03vBPYJ1o' ),
				'name' => esc_html__( 'Divi WooCommerce Modules', 'et_builder' ),
			),
		);
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_fields() {
		$fields = array(
			'required_field_indicator_color' => array(
				'label'           => esc_html__(
					'Required Field Indicator Color',
					'et_builder'
				),
				'description'     => esc_html__(
					'Pick a color to be used for the required field indicator.',
					'et_builder'
				),
				'type'            => 'color-alpha',
				'option_category' => 'button',
				'custom_color'    => true,
				'default'         => '',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'field_label',
				'hover'           => 'tabs',
				'mobile_options'  => true,
				'priority'        => 5,
			),
			'fields_width'                   => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'fields_width'
			),
			'__checkout_billing'             => array(
				'type'                => 'computed',
				'computed_callback'   => array(
					'ET_Builder_Module_Woocommerce_Checkout_Billing',
					'get_checkout_billing',
				),
				'computed_depends_on' => array(

					/*
					 * `depends_on` arg is required. Otherwise AJAX will return null.
					 * @see et_pb_process_computed_property().
					 * `product` will not be processed since there is no definition in
					 * @see ET_Builder_Module_Woocommerce_Checkout_Order::get_fields()
					 */
					'product',
				),
			),
			'placeholder_color'              => ET_Builder_Module_Helper_Woocommerce_Modules::get_field(
				'placeholder_color'
			),
		);

		return $fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_transition_fields_css_props() {
		$fields = parent::get_transition_fields_css_props();

		$fields['required_field_indicator_color'] = array(
			'color' => '%%order_class%% form .form-row .required',
		);
		$fields['placeholder_color']              = array(
			'color' => array(
				'%%order_class%% form .input-text::placeholder',
				'%%order_class%% form .input-text::-webkit-input-placeholder',
				'%%order_class%% form .input-text::-moz-placeholder',
				'%%order_class%% form .input-text:-ms-input-placeholder',
			),
		);

		return $fields;
	}

	/**
	 * Reset hooks.
	 */
	public static function maybe_reset_hooks() {
		ET_Builder_Module_Helper_Woocommerce_Modules::attach_wc_checkout_coupon_form();
		ET_Builder_Module_Helper_Woocommerce_Modules::attach_wc_checkout_login_form();
		ET_Builder_Module_Helper_Woocommerce_Modules::attach_wc_checkout_order_review();
		ET_Builder_Module_Helper_Woocommerce_Modules::attach_wc_checkout_payment();

		add_action(
			'woocommerce_checkout_shipping',
			[
				WC_Checkout::instance(),
				'checkout_form_shipping',
			]
		);
	}

	/**
	 * Handle hooks.
	 */
	public static function maybe_handle_hooks() {
		ET_Builder_Module_Helper_Woocommerce_Modules::detach_wc_checkout_coupon_form();
		ET_Builder_Module_Helper_Woocommerce_Modules::detach_wc_checkout_login_form();
		ET_Builder_Module_Helper_Woocommerce_Modules::detach_wc_checkout_order_review();
		ET_Builder_Module_Helper_Woocommerce_Modules::detach_wc_checkout_payment();

		remove_action(
			'woocommerce_checkout_shipping',
			[
				WC_Checkout::instance(),
				'checkout_form_shipping',
			]
		);
	}

	/**
	 * Gets the Billing markup.
	 *
	 * @return string
	 */
	public static function get_checkout_billing() {
		if ( ! class_exists( 'WC_Shortcode_Checkout' ) ||
			! method_exists( 'WC_Shortcode_Checkout', 'output' ) ) {
			return '';
		}

		self::maybe_handle_hooks();

		$is_cart_empty = function_exists( 'WC' ) && isset( WC()->cart ) && WC()->cart->is_empty();
		$is_pb_mode    = et_fb_is_computed_callback_ajax();
		$class         = 'ET_Builder_Module_Helper_Woocommerce_Modules';

		// Set dummy cart contents to output Billing when no product is in cart.
		if ( $is_cart_empty && $is_pb_mode ) {
			add_filter(
				'woocommerce_get_cart_contents',
				// phpcs:ignore WordPress.Arrays.CommaAfterArrayItem.NoComma -- Call to a function.
				array( $class, 'set_dummy_cart_contents' )
			);
		}

		ob_start();
		WC_Shortcode_Checkout::output( array() );
		$markup = ob_get_clean();

		if ( $is_cart_empty && $is_pb_mode ) {
			remove_filter(
				'woocommerce_get_cart_contents',
				// phpcs:ignore WordPress.Arrays.CommaAfterArrayItem.NoComma -- Call to a function.
				array( $class, 'set_dummy_cart_contents' )
			);
		}

		self::maybe_reset_hooks();

		// Fallback.
		if ( ! is_string( $markup ) ) {
			$markup = '';
		}

		return $markup;
	}

	/**
	 * Renders the module output.
	 *
	 * @param  array  $attrs       List of attributes.
	 * @param  string $content     Content being processed.
	 * @param  string $render_slug Slug of module that is used for rendering output.
	 *
	 * @return string
	 */
	public function render( $attrs, $content, $render_slug ) {
		if ( function_exists( 'is_order_received_page' )
			&& is_order_received_page() ) {
			return '';
		}

		$output = self::get_checkout_billing();

		$fields_width = et_()->array_get( $this->props, 'fields_width', false );
		if ( false !== $fields_width ) {
			$this->add_classname( "et_pb_fields_layout_{$fields_width}" );
		}

		// Handle Required Field Indicator Color responsive and hover fields.
		$required_field_indicator_color_values = et_pb_responsive_options()->get_property_values( $this->props, 'required_field_indicator_color' );
		$required_field_indicator_color_hover  = $this->get_hover_value( 'required_field_indicator_color' );
		$required_field_indicator_selector     = '%%order_class%% form .form-row .required';

		et_pb_responsive_options()->generate_responsive_css(
			$required_field_indicator_color_values,
			$required_field_indicator_selector,
			'color',
			$render_slug,
			' !important;',
			'color'
		);

		// Placeholder Color.
		$placeholder_selectors = array(
			'%%order_class%% form .form-row input.input-text::placeholder',
			'%%order_class%% form .form-row input.input-text::-webkit-input-placeholder',
			'%%order_class%% form .form-row input.input-text::-moz-placeholder',
			'%%order_class%% form .form-row input.input-text:-ms-input-placeholder',
		);

		$this->generate_styles(
			array(
				'base_attr_name'                  => 'placeholder_color',
				'selector'                        => join( ', ', $placeholder_selectors ),
				'hover_pseudo_selector_location'  => 'suffix',
				'sticky_pseudo_selector_location' => 'prefix',
				'css_property'                    => 'color',
				'important'                       => false,
				'render_slug'                     => $render_slug,
				'type'                            => 'color',
			)
		);

		if ( et_builder_is_hover_enabled( 'required_field_indicator_color', $this->props ) ) {
			ET_Builder_Element::set_style(
				$render_slug,
				array(
					'selector'    => '%%order_class%% form .form-row:hover .required',
					'declaration' => sprintf(
						'color: %1$s;',
						esc_html( $required_field_indicator_color_hover )
					),
				)
			);
		}

		$this->add_classname( $this->get_text_orientation_classname() );

		global $wp;
		if ( ! empty( $wp->query_vars['order-pay'] ) ) {
			$this->add_classname( 'et_pb_wc_order_pay' );
		}

		if ( isset( WC()->cart )
			&& ! is_null( WC()->cart && method_exists( WC()->cart, 'check_cart_items' ) ) ) {
			$return = WC()->cart->check_cart_items();

			if ( wc_notice_count( 'error' ) > 0 ) {
				$this->add_classname( 'et_pb_hide_module' );
			}
		}

		return $this->_render_module_wrapper( $output, $render_slug );
	}
}

new ET_Builder_Module_Woocommerce_Checkout_Billing();
