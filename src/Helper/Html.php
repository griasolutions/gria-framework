<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

class Html extends HelperAbstract
{

    public function createAnchorElement(array $params)
    {
        if (!isset($params['label'])) {
            throw new \Exception();
        }
        $label = $params['label'];
        unset($params['label']);
        $dom = $this->createDOMElement('a', $params);
        $dom->firstChild->nodeValue = $label;
        return trim($dom->saveHTML());
    }

    /**
     * @param string $tag
     * @param array $params
     * @return \DOMDocument
     */
    public function createDOMElement($tag, array $params)
    {
        $dom = new \DOMDocument();
        $anchorElement = $dom->createElement($tag);
        foreach ($params as $key => $value) {
            $anchorElement->setAttribute($key, $value);
        }
        $dom->appendChild($anchorElement);
    }

} 