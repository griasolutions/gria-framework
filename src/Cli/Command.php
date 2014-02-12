<?php

namespace Gria\Cli;

use \Gria\Config;
use \Gria\Controller;

// APPLICATION=WP-Write WORKSPACE_PATH=`pwd`/wp-write REPOSITORY_URL=git@bitbucket.org:guillermoandrae/wp-write.git ~/Sites/gria-ci/bin/build.sh

abstract class Command
{

	use Config\ConfigAwareTrait;

	private $_scriptPath;

	public function __construct(Config\Config $config)
	{
		$this->setConfig($config);
		$this->init();
	}

	public function init()
	{
	}

	abstract public function run();

	public function executeCommand()
	{
		exec($this->getCommand(), $output, $exitStatus);

		return $exitStatus;
	}

	abstract public function getCommand();

	public function setScriptPath($scriptPath)
	{
		$this->_scriptPath = $scriptPath;
	}

	public function getScriptPath()
	{
		return $this->_scriptPath;
	}

}
