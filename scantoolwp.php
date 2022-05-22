<?php 
/**
 * Plugin Name:       Scan Tool Wp
 * Description:       Muestra información de Wordpress.
 * Version:           1.0.0
 * Author:            Ivan Hernandez
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       scan-tool-wp
 * Domain Path:       /languages
 */


if ( ! defined('WPINC')) {
	die;
}


function scan_tool_wp_settings_page() 
{
	add_menu_page (
		'Scan Tool WP',
		'Scan Tool WP',
		'manage_options',
		'scan-tool-wp',
		'scan_tool_wp_settings_page_markup',
		'dashicons-wordpress-alt',
		100
	);

	add_submenu_page(
		'scan-tool-wp',
		__('Scan Tool WP - Dashboard', 'scan-tool-wp'),
		__('Dashboard', 'scan-tool-wp'),
		'manage_options',
		'scan-tool-wp-dashboard',
		'scan_tool_wp_settings_subpage_dashboard_markup',
	);

	add_submenu_page(
		'scan-tool-wp',
		__('Scan Tool WP - About', 'scan-tool-wp'),
		__('About', 'scan-tool-wp'),
		'manage_options',
		'scan-tool-wp-about',
		'scan_tool_wp_settings_subpage_about_markup',
	);
}
add_action('admin_menu', 'scan_tool_wp_settings_page' );


function scan_tool_wp_settings_page_markup() 
{
	if ( !current_user_can('manage_options') ) {
		return;
	}
	?>
	<div class="wrap">
		<h1> <?php esc_html_e(get_admin_page_title() ); ?> </h1>
		<p> <?php esc_html_e('Contenido', 'scan-tool-wp'); ?> </p>
	</div>
	<?php 
}

function scan_tool_wp_settings_subpage_dashboard_markup() 
{
	if ( !current_user_can('manage_options') ) {
		return;
	}
	?>
	<div class="wrap">
		<h1> <?php esc_html_e(get_admin_page_title() ); ?> </h1>
		
		<h3><b> <?php esc_html_e('Contenido Dashboard:'); ?></b></h3>				
		<p><?php echo ('<b>Nombre del sitio:</b> ') .  get_bloginfo('name'); ?></p>
		<p><?php echo ('<b>Url de instalación:</b> ') .  get_bloginfo('url'); ?></p>
		<p><?php echo ('<b>Url de Wordpress:</b> ') .  get_bloginfo('wpurl'); ?></p>
		<p><?php echo ('<b>Versión de WordPres:</b> ') .  get_bloginfo('version'); ?></p>		
		<p> <?php echo ('<b>Lista de Temas:</b> ')  ?> </p>
		<?php			
			 $theme_data = wp_get_themes();

			 foreach($theme_data as $value){
				print_r ($value['Name'] ."<br />");
			}

		?>
		<p><?php echo ('<b>Lista de plugins:</b> ')?></p>
		<?php		
			$plugin_data = get_plugins();

			 foreach($plugin_data as $value){
				print_r ($value['Name'] ."<br />");
			}

		 ?>		
		<p>
		<?php
			$count_pages = wp_count_posts('page');
			$total_pages = $count_pages->publish;
			echo '<b>Número de páginas publicadas:</b> ' . $total_pages; 
		?>			
		</p>
		<p>
		<?php
			function wpb_total_posts() { 
				$total = wp_count_posts()->publish;
				echo '<b>Número de blogs publicados:</b> ' . $total;
			}	 
			wpb_total_posts(); 
		?>
		</p>		
	</div>
	<?php 
}

function scan_tool_wp_settings_subpage_about_markup() 
{
	if ( !current_user_can('manage_options') ) {
		return;
	}
	?>
	<div class="wrap">
		<h1> <?php esc_html_e(get_admin_page_title() ); ?> </h1>		
		
		<h3><b> <?php esc_html_e('Contenido About:'); ?></b></h3>
		<p><?php echo ('<b>Nombre del Autor del plugin:</b> Ivan Hernandez '); ?></p>
		<a href="https://www.facebook.com/nativapp" style="text-decoration: none;" target="_blank"><span class="dashicons dashicons-facebook"></span></a>

		<a href="https://www.instagram.com/nativapps/" style="text-decoration: none;" target="_blank"><span class="dashicons dashicons-instagram"></span></a>

		<a href="https://www.linkedin.com/company/nativapps-inc/" style="text-decoration: none;" target="_blank"><span class="dashicons dashicons-linkedin"></span></a>				
	</div>
	<?php 
}

?>
