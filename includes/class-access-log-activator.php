<?php

/**
 * Fired during plugin activation
 *
 * @link       https://benoithubert.me
 * @since      1.0.0
 *
 * @package    Access_Log
 * @subpackage Access_Log/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Access_Log
 * @subpackage Access_Log/includes
 * @author     Benoît Hubert <benoithubert@gmail.com>
 */
class Access_Log_Activator {

  /**
	 * Current DB version.
	 */
	const DB_VERSION = '1.0.0';

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// if ( self::DB_VERSION !== get_site_option( 'wpaccesslog_db_version' ) ) {
			global $wpdb;

			$charset_collate = $wpdb->get_charset_collate();

			$sql = 'CREATE TABLE ' . $wpdb->prefix . 'wpaccesslog' . " (
				id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
				req_ip VARCHAR(39) NOT NULL,
				req_recv_at TIMESTAMP NOT NULL,
				req_method VARCHAR(7) NOT NULL,
				req_pathname LONGTEXT NOT NULL,
				req_proto VARCHAR(10) NOT NULL,
				req_referer LONGTEXT NOT NULL,
        req_user_agent LONGTEXT NOT NULL,
				res_status SMALLINT NULL DEFAULT NULL,
        res_content_length INT UNSIGNED NULL DEFAULT NULL,
				PRIMARY KEY (id)) $charset_collate;";
      ob_start();
  		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
			dbDelta( $sql );
      ob_end_clean();

			update_option( 'wpaccesslog_db_version', self::DB_VERSION );
		// }
	}
}
