<?php
/**
 * Activator Class File
 *
 * This file contains Activator class. If you want to perform some actions
 * in activating of your plugin, you can add your desire methods to it.
 * Actions likes installing separated tables (except WordPress tables),
 * initializing configs for plugin and using update_option, can do with this class.
 *
 * @package    Plugin_Name_Dir\Includes\Init
 * @author     Your_Name <youremail@nomail.com>
 * @license    https://www.gnu.org/licenses/gpl-3.0.txt GNU/GPLv3
 * @link       https://yoursite.com
 * @since      1.0.0
 */

namespace Plugin_Name_Dir\Includes\Init;

use Plugin_Name_Dir\Includes\Database\Table;
use Plugin_Name_Dir\Includes\Config\Info;

/**
 * Class Activator.
 * If you want to perform some actions in activating of your plugin, you can add your desire methods to it.
 * Actions likes installing separated tables (except WordPress tables),
 * initializing configs for plugin and using update_option, can do with this class.
 *
 * @package    Plugin_Name_Dir\Includes\Init
 * @author     Your_Name <youremail@nomail.com>
 * @see        \Plugin_Name_Dir\Includes\Config\Info
 * @see        \Plugin_Name_Dir\Includes\Database\Table
 */
class Activator {

	/**
	 * Method activate in Activator Class
	 *
	 * It calls when plugin is activated.
	 *
	 * @access  public
	 * @static
	 */
	public static function activate() {
		$new_modified_tables = new Table();
        $new_modified_tables->create_ELECTION_sms_verification();

       Info::add_info_in_plugin_activation();
	}
}

