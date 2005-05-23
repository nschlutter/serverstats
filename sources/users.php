<?php
/**
 * $Id$
 *
 * Author: David Danier, david.danier@team23.de
 * Project: Serverstats, http://www.webmasterpro.de/~ddanier/serverstats/
 * License: GPL v2 or later (http://www.gnu.org/copyleft/gpl.html)
 */

class users extends source
{
	private $usersbin;
	private $count;

	public function __construct($usersbin = '/usr/bin/users')
	{
		$this->usersbin = $usersbin;
	}
	
	public function refreshData()
	{
		$this->count = count(explode(' ', trim(exec(escapeshellcmd($this->usersbin)) . ' x'))) - 1;
	}

	public function initRRD(rrd $rrd)
	{
		$rrd->addDatasource('users');
	}

	public function updateRRD(rrd $rrd)
	{
		$rrd->setValue('users', $this->count);
	}
}

?>
