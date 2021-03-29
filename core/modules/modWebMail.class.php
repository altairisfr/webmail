<?php
/* Copyright (C) 2012	Christophe Battarel	<christophe.battarel@altairis.fr>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

/**     \defgroup   webmail     Module Webmail
 *      \brief      Module to manage mail via RoudCube in Dolibarr
 *      \file       htdocs/custom/webmail/core/modules/modWebMail.class.php
 *      \ingroup    prices
 *      \brief      Description and activation file for module Webmail
 */
include_once DOL_DOCUMENT_ROOT .'/core/modules/DolibarrModules.class.php';


/**
 * 	Class to describe module Webmail
 */
class modWebMail extends DolibarrModules
{
	/**
	 * 	Constructor
	 *
	 * 	@param	DoliDB	$db		Database handler
	 */
	function __construct($db)
	{
		$this->db = $db;

		// Id for module (must be unique).
		// Use here a free id (See in Home -> System information -> Dolibarr for list of used modules id).
		$this->numero = 140003;
		// Key text used to identify module (for permissions, menus, etc...)
		$this->rights_class = 'webmail';

		// Family can be 'crm','financial','hr','projects','products','ecm','technic','other'
		// It is used to group modules in module setup page
		$this->family = "other";
		// Module label (no space allowed), used if translation string 'ModuleXXXName' not found (where XXX is value of numeric property 'numero' of module)
		$this->name = preg_replace('/^mod/i','',get_class($this));
		// Module description, used if translation string 'ModuleXXXDesc' not found (where XXX is value of numeric property 'numero' of module)
		$this->description = "Webmail integration";
		// Possible values for version are: 'development', 'experimental', 'dolibarr' or version
		$this->version = 'dolibarr';
		// Key used in llx_const table to save module status enabled/disabled (where MYMODULE is value of property name of module in uppercase)
		$this->const_name = 'MAIN_MODULE_'.strtoupper($this->name);
		// Where to store the module in setup page (0=common,1=interface,2=other)
		$this->special = 0;
		// Name of png file (without png) used for this module.
		// Png file must be in theme/yourtheme/img directory under name object_pictovalue.png.
		$this->picto='webmail@webmail';

		// Data directories to create when module is enabled.
		$this->dirs = array('/webmail/temp');

		// Relative path to module style sheet if exists. Example: '/mymodule/mycss.css'.
		//$this->style_sheet = '/webmail/css/webmail.css';

		// Config pages. Put here list of php page names stored in admmin directory used to setup module.
		$this->config_page_url = array("webmail.php@webmail");

		// Dependencies
		$this->depends = array();		// List of modules id that must be enabled if this module is enabled
		$this->requiredby = array();				// List of modules id to disable if this one is disabled
		$this->phpmin = array(5,1);					// Minimum version of PHP required by module
		$this->need_dolibarr_version = array(3,1);	// Minimum version of Dolibarr required by module
		$this->langfiles = array("webmail@webmail");

		// Constants
		$this->const = array();			// List of particular constants to add when module is enabled

		// New pages on tabs
		$this->tabs = array(
				'thirdparty:+webmail@webmail:Emails:webmail@webmail:$conf->webmail->enabled && $user->rights->webmail->acces_tiers:/webmail/tabs/thirdpartyEmails.php?socid=__ID__'
//				,'product:-price',
//				,'product:-suppliers'
		);

		// hooks
		$this->module_parts = array(
//			'hooks' => array('productcard','ordercard','propalcard','invoicecard')  // Set here all hooks context managed by module
		);
		
		// Boxes
		$this->boxes = array();			// List of boxes
		$r=0;


		// Permissions
		$this->rights = array();		// Permission array used by this module
        $this->rights_class = 'webmail';
        $r=0;

        // $this->rights[$r][0]     Id permission (unique tous modules confondus)
        // $this->rights[$r][1]     Libelle par defaut si traduction de cle "PermissionXXX" non trouvee (XXX = Id permission)
        // $this->rights[$r][2]     Non utilise
        // $this->rights[$r][3]     1=Permis par defaut, 0=Non permis par defaut
        // $this->rights[$r][4]     Niveau 1 pour nommer permission dans code
        // $this->rights[$r][5]     Niveau 2 pour nommer permission dans code

        $r++;
        $this->rights[$r][0] = 1400031;
        $this->rights[$r][1] = 'Access webmail total (icône)';
        $this->rights[$r][2] = 'r';
        $this->rights[$r][3] = 0;
        $this->rights[$r][4] = 'acces_total';

        $r++;
        $this->rights[$r][0] = 1400032;
        $this->rights[$r][1] = 'Access webmail sur fiches tiers';
        $this->rights[$r][2] = 'r';
        $this->rights[$r][3] = 0;
        $this->rights[$r][4] = 'acces_tiers';


		// Main menu entries
		$this->menu = array();			// List of menus to add
		$r = 0;
	    // top menu entry

	   $this->menu[$r]=array(
					'fk_menu'=>0,			// Put 0 if this is a top menu
	    			'type'=>'top',			// This is a Top menu entry
	    			'titre'=>'Emails',
	    			'mainmenu'=>'webmail',
	    			'leftmenu'=>'1',		// Use 1 if you also want to add left menu entries using this descriptor. Use 0 if left menu entries are defined in a file pre.inc.php (old school).
	    			'url'=>'/webmail/index.php',
	    			'langs'=>'webmail@webmail',	// Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
	    			'position'=>100,
	    			'enabled'=>'$conf->webmail->enabled && $user->rights->webmail->acces_total',			// Define condition to show or hide menu entry. Use '$conf->monmodule->enabled' if entry must be visible if module is enabled.
	    			'perms'=>'$user->rights->webmail->acces_total',			// Use 'perms'=>'$user->rights->monmodule->level1->level2' if you want your menu with a permission rules
	    			'target'=>'',
	    			'user'=>0);				// 0=Menu for internal users, 1=external users, 2=both
	    $r++;
	}

	/**
     *	Function called when module is enabled.
     *	The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
     *	It also creates data directories.
     *
     *	@return     int             1 if OK, 0 if KO
     */
	function init($options = '')
  	{
		global $db;
		
		// use datatable
//		dolibarr_set_const($db, 'MAIN_USE_JQUERY_DATATABLES', 1);//, 'string', 0, '', $conf->entity)

		$sql = array();

		$result=$this->load_tables();

    	return $this->_init($sql);
  	}

	/**
	 *	Function called when module is disabled.
	 *	Remove from database constants, boxes and permissions from Dolibarr database.
	 *	Data directories are not deleted.
	 *
	 *	@return     int             1 if OK, 0 if KO
 	 */
	function remove($options = '')
	{
    	$sql = array();

    	return $this->_remove($sql);
  	}


	/**
	 * 	Create tables and keys required by module
	 * 	Files mymodule.sql and mymodule.key.sql with create table and create keys
	 * 	commands must be stored in directory /mymodule/sql/
	 * 	This function is called by this->init.
	 *
	 * 	@return		int		<=0 if KO, >0 if OK
	 */
  	function load_tables()
	{
		  return 1;
	}
}

?>
