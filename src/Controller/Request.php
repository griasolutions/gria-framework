<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Http;

class Request extends Http\Request
{

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $url = 'http://' . filter_input(INPUT_SERVER, 'HTTP_HOST') . filter_input(INPUT_SERVER, 'REQUEST_URI');
        parent::__construct($url);
    }

}