<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application\Environment;

trait EnvironmentAwareTrait
{

    /** @var \Gria\Application\Environment\EnvironmentInterface */
    private $environment;

    /**
     * Registers the provided {@link \Gria\Application\Environment\EnvironmentInterface}
     * with this class.
     *
     * @param \Gria\Application\Environment\EnvironmentInterface $environment
     * @return \Gria\Config\ConfigInterface
     */
    public function setEnvironment(EnvironmentInterface $environment)
    {
        $this->environment = $environment;
    }

    /**
     * Returns the instance of {@link \Gria\Application\Environment\EnvironmentInterface}
     * registered with this class.
     *
     * @return \Gria\Application\Environment\EnvironmentInterface
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

} 