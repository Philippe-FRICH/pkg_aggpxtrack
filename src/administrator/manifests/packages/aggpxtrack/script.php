<?php
/**
 * @package     Joomla.Site
 * @subpackage  pkg_aggpxtrack
 *
 * @copyright   Copyright (C) 2005 - 2018 Astrid Günther, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later;
 * @link        astrid-guenther.de
 */

defined('_JEXEC') or die;

/**
 * Installation class to perform additional changes during install/uninstall/update
 *
 * @since  1.0.76
 */
class Pkg_AggpxtrackInstallerScript extends JInstallerScript
{
	/**
	 * Extension script constructor.
	 *
	 * @since   1.0.76
	 */
	public function __construct()
	{
		$this->minimumJoomla = '4.0.0-beta1-dev';
		$this->minimumPhp    = JOOMLA_MINIMUM_PHP;
	}

	/**
	 * Method to run after the install routine.
	 *
	 * @param   string                      $type    The action being performed
	 * @param   JInstallerAdapterComponent  $parent  The class calling this method
	 *
	 * @return  void
	 *
	 * @since   1.0.76
	 */
	public function postflight($type, $parent)
	{
		return $this->copyFiles();
	}

	/**
	 * Method to rcopy files.
	 *
	 * @return  boolean
	 *
	 * @since   1.0.76
	 */
	public function copyFiles()
	{
		$mode = 0755;
		$path = JPATH_SITE . "/images/com_aggpxtrack/";
		JFolder::create($path, $mode);

		$pathsearch = JPATH_SITE . "/media/plg_fields_aggpxtrack/gpxfiles/";

		$gpx_files = JFolder::files($pathsearch, '.gpx');

		foreach ($gpx_files as $file)
		{
			if (!file_exists($path . $file))
			{
				JFile::copy($pathsearch . $file, $path . $file);
			}
		}

		return true;
	}
}
