<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application\Environment;

interface EnvironmentInterface
{

    /**
     * Returns the name of the current environment.
     *
     * @return string
     */
    public function getName();

    /**
     * Returns true if environment is production, false otherwise.
     *
     * @return bool
     */
    public function isProduction();

    /**
     * Returns true if environment is qa, false otherwise.
     *
     * @return bool
     */
    public function isQa();

    /**
     * Returns true if environment is development, false otherwise.
     *
     * @return bool
     */
    public function isDevelopment();

    /**
     * Returns true if environment is test, false otherwise.
     *
     * @return bool
     */
    public function isTest();

} 