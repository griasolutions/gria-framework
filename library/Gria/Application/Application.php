<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application;

use \Gria\Config;
use \Gria\Controller;
use \Gria\Db;

class Application
{

	use Config\ConfigAwareTrait;

	/**
	 * @param string $path
	 */
	public function __construct($path)
	{
		$this->setConfig(new Config\Config($path));
	}

	/**
	 * @return void
	 */
	public function run()
	{
		$config = $this->getConfig();
		Db\Db::setDsn($config->get('dsn'));
		(new Controller\Dispatcher(new Controller\Request(), $config))->run();
	}

} 