<?php

namespace DtlUser;

use Zend\Mvc\MvcEvent;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e) {
        $app = $e->getApplication();
        $eventManager = $app->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'changeLayout'));
    }

    public function changeLayout($e) {
        $match = $e->getRouteMatch()->getMatchedRouteName();
        if ($match === 'zfcuser/login') {
            $controller = $e->getTarget();
            $controller->layout('layout/login');
            return;
        }
    }

}
