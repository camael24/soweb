<?php

/* @var $this \Sohoa\Framework\Router */

// Defines the defaults route
$this->get('/', array('as' => 'root', 'to' => 'Main#index'));

// The following code allows to route uri like
// http://domain.com/customController/customAction/
// http://domain.com/customController/customAction/myParam

$this->setRessource(\Sohoa\Framework\Router::REST_SHOW, null , null  , '/(?<%s>.*)');
$this->resource('doc' , array('only' => array('show' , 'index')));



/**
* $err = $this->getFramework()->getErrorHandler();
*$err->handleErrorsAsException();
*$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ALL_ERROR, 'Error#Default');
*$err->routeError(\Sohoa\Framework\ErrorHandler::ROUTE_ERROR_404, 'Error#Err404');
*$err->routeError('\ErrorException', 'Error#PHP');
*/
