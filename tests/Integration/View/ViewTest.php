<?php

namespace GriaTest\Unit\View;

use \Gria\View;
use \Gria\Test;

class ViewTest extends Test\IntegrationTestAbstract
{

    public function testGetSetPath()
    {
        $view = $this->getMockView();
        $path = 'example';
        $expectedPath = sprintf('%s/%s.%s', $view->getDefaultBasePath(), $path, $view->getDefaultExtension());
        $view->setPath($path);
        $this->assertEquals($expectedPath, $view->getPath(),
            'Verified that view path is built correctly using default settings.');
    }

    public function testGetSetPathCustom()
    {
        $viewPath = 'custom-view';
        $customBasePath = __DIR__ . '/';
        $customExtension = 'inc';
        $customConfig = array('view' => array(
            'basePath' => $customBasePath,
            'extension' => $customExtension
        ));
        $view = $this->getMockView($customConfig);
        $this->assertEquals($customConfig['view'], $view->getConfig()->get('view'));
        $expectedPath = sprintf('%s/%s.%s', $customBasePath, $viewPath, $customExtension);
        $view->setPath($viewPath);
        $this->assertEquals($expectedPath, $view->getPath(),
            'Verified that view path is built correctly using custom settings.');
    }

    /**
     * @expectedException \Gria\View\InvalidViewException
     */
    public function testRenderInvalidView()
    {
        $view = $this->getMockView();
        $view->setPath('invalid');
        $view->render();
    }

    public function testRender()
    {
        $customBasePath = __DIR__ . '/';
        $customConfig = array('view' => array(
            'basePath' => $customBasePath
        ));
        $viewContent = 'This is a view file!';
        $viewPath = 'view-render';
        $view = $this->getMockView($customConfig);
        $fullViewPath = __DIR__ . '/' . $viewPath . '.' . $view->getDefaultExtension();
        file_put_contents($fullViewPath, $viewContent);
        $view->setPath($viewPath);
        $this->assertEquals($viewContent, $view->render(),
            'Verified that the view renders.');
        unlink($fullViewPath);
    }


    public function getMockView(array $data = ['name' => 'Test Application'])
    {
        $view = new View\View($this->getMockConfig($data), $this->getMockHelperManager($data));
        return $view;
    }

} 