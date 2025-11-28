<?php
/**
 * Plugin Name: Job Posting Widget for Elementor
 * Description: This Elementor addon automatically adds structured data / schema markup for job postings to your job page.
 * Plugin URI:  https://wordpress.org/plugins/job-posting-widget-for-elementor/
 * Version:     1.0.0
 * Author:      Dein SEO Kurs
 * Author URI:  https://dein-seo-kurs.de/
 * Text Domain: job-posting-widget-for-elementor
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * WordPress Available: yes
 * Requires License: yes
 * Requires Plugins: elementor
 * Elementor tested up to: 3.33.0
 * Elementor Pro tested up to: 3.33.1
 *
 * @package El_Job_Posting_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin activation.
 */
function el_job_posting_free_activation() {
	if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die(
			esc_html__( 'This plugin requires Elementor to be installed and active.', 'job-posting-widget-for-elementor' ),
			'Plugin dependency check',
			array(
				'back_link' => true,
			)
		);
	}
}
register_activation_hook( __FILE__, 'el_job_posting_free_activation' );

/**
 * Plugin deactivation.
 */
function el_job_posting_free_deactivation() {
	// Deactivation code here.
}
register_deactivation_hook( __FILE__, 'el_job_posting_free_deactivation' );

/**
 * Register schema widget.
 *
 * @param object $widgets_manager Elementor manager.
 */
function el_job_posting_register_widget( $widgets_manager ) {
	require_once __DIR__ . '/widget/class-el-job-posting-widget.php';
	$widgets_manager->register( new \El_Job_Posting_Widget() );
}
add_action( 'elementor/widgets/register', 'el_job_posting_register_widget' );
