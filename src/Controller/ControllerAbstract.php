<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\View;
use \Gria\Config;
use \Gria\Helper;
use \Gria\Http;

abstract class ControllerAbstract implements ControllerInterface
{

    use Http\RequestAwareTrait, Config\ConfigAwareTrait, Helper\HelperManagerAwareTrait;

    /** @var string */
    private $name;

    /** @var \Gria\Http\Response\ResponseInterface */
    private $response;

    /**
     * @inheritdoc
     */
    public function __construct(Request $request, Config\ConfigInterface $config, Helper\Manager $helperManager)
    {
        $this->name = substr(strtolower(str_replace(__NAMESPACE__, '', get_class($this))), 1);
        $this->setRequest($request);
        $this->setConfig($config);
        $this->setHelperManager($helperManager);
        $this->response = new Http\Response();
        $this->init();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function respond()
    {
        $this->getResponse()->send();
    }

    /**
     * @inheritdoc
     */
    public function getResponse()
    {
        return $this->response;
    }

}