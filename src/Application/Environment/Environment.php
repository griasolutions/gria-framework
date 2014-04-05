<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application\Environment;

class Environment implements EnvironmentInterface
{

    const ENV_PRODUCTION = 'production';
    const ENV_QA = 'qa';
    const ENV_DEVELOPMENT = 'development';
    const ENV_TEST = 'test';

    /**
     * Returns the environment name.
     *
     * @see \Gria\Application\Environment::getName()
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return GRIA_ENV;
    }

    /**
     * @inheritdoc
     */
    public function isProduction()
    {
        return ($this->getName() == static::ENV_PRODUCTION);
    }

    /**
     * @inheritdoc
     */
    public function isQa()
    {
        return ($this->getName() == static::ENV_QA);
    }

    /**
     * @inheritdoc
     */
    public function isDevelopment()
    {
        return ($this->getName() == static::ENV_DEVELOPMENT);
    }

    /**
     * @inheritdoc
     */
    public function isTest()
    {
        return ($this->getName() == static::ENV_TEST);
    }

} 