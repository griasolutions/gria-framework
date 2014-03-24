<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

class NavigationHelper extends HelperAbstract
{

    private $_menuItems;
    private $_menuContainer;
    private $_menuContainerAttributes;

    /**
     * @return string
     */
    public function render()
    {
        $dom = new \DOMDocument();
        $containerElement = $dom->createElement($this->getMenuContainer());
        $listElement = $dom->createElement('ul');

        foreach ($this->getMenuItems() as $menuItem) {
            $menuItemElement = $dom->createElement('li');
            $anchorElement = $dom->createElement('a');
            if (isset($menuItem['controller']) && isset($menuItem['action'])) {
                $href = sprintf('/%s/%s', $menuItem['controller'], $menuItem['action']);
                $anchorElement->setAttribute('href', $href);
                unset($menuItem['controller'], $menuItem['action']);
            } elseif (isset($menuItem['href'])) {
                $anchorElement->setAttribute('href', $menuItem['href']);
            }
            if (isset($menuItem['title'])) {
                $anchorElement->setAttribute('title', $menuItem['title']);
            }
            if (isset($menuItem['class'])) {
                $menuItemElement->setAttribute('class', $menuItem['class']);
            }
            $anchorElement->nodeValue = $menuItem['label'];
            $menuItemElement->appendChild($anchorElement);
            if (isset($menuItem['active']) && $menuItem['active']) {
                $menuItemElement->setAttribute('class', 'active');
            }
            $listElement->appendChild($menuItemElement);
        }
        $containerElement->appendChild($listElement);
        $dom->appendChild($containerElement);
        return trim($dom->saveHTML());
    }

    /**
     * @param array $menuItems
     * @return $this
     */
    public function setMenuItems(array $menuItems)
    {
        $this->_menuItems = $menuItems;
        return $this;
    }

    /**
     * @return array
     */
    public function getMenuItems()
    {
        return $this->_menuItems;
    }

    /**
     * @param array $menuItems
     * @return $this
     */
    public function addMenuItems(array $menuItems)
    {
        $this->_menuItems[] = $menuItems;
        return $this;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function removeMenuItems(array $params)
    {
        foreach ($this->_menuItems as $menuItem) {
            foreach($menuItem as $key => $value) {
                if (isset($params[$key]) && $params[$key] == $value) {
                    $index = array_search($menuItem, $this->_menuItems);
                    array_splice($this->_menuItems, $index, 1);
                }
            }
        }
        return $this;
    }

    /**
     * @param string $menuContainer
     * @return $this
     */
    public function setMenuContainer($menuContainer)
    {
        $this->_menuContainer = $menuContainer;
        return $this;
    }

    /**
     * @return string
     */
    public function getMenuContainer()
    {
        return $this->_menuContainer;
    }

    /**
     * @param array $menuContainerAttributes
     */
    public function setMenuContainerAttributes($menuContainerAttributes)
    {
        $this->_menuContainerAttributes = $menuContainerAttributes;
    }

    /**
     * @return array
     */
    public function getMenuContainerAttributes()
    {
        return $this->_menuContainerAttributes;
    }

} 