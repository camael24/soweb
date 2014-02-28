<?php

/**
 * Description of Dummy
 *
 * @author Guile
 */

namespace Application\View\Helper {

    use Sohoa\Framework\View;

    class Router extends View\Helper
    {

        public function to($id , $array = array())
        {
            $router = $this->view->getRouter();

           return $router->unroute($id , $array);
        }
    }

}
