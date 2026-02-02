<?php
/**
 * Add custom title for each part in sections.
 *
 * @package Gt addons
 */

/**
 * Title class.
 */
class GT_Customize_Title_Control extends WP_Customize_Control {
	/**
	 * Control's type.
	 *
	 * @var string
	 */
	public $type = 'gt-title';

	/**
	 * Render the control's content.
	 */
	public function render_content() {
		?>
		<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
		<?php
	}
}
