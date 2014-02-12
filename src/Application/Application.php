<?php
/**
 * This file is part of the Gria Framework package.
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
        $this->_checkEnvironment();
        $this->setConfig(new Config\Config($path));
	}

	/**
	 * @return void
	 */
	public function run()
	{
		$config = $this->getConfig();
		if ($dsn = $config->get('dsn')) {
			Db\Db::setDsn($dsn);
		}
		(new Controller\Dispatcher(new Controller\Request(), $config))->run();
	}

    /**
     * @throws InvalidEnvironmentException
     */
    private function _checkEnvironment()
    {
        if (!defined('GRIA_ENV')) {
            throw new InvalidEnvironmentException('No environment defined.');
        }
    }

}