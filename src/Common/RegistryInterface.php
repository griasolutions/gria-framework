<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common;

interface RegistryInterface extends \ArrayAccess
{

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function encodeOffset($offset);

} 