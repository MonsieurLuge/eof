<?php

namespace EOF\Router;

use Symfony\Component\HttpFoundation\Request;

interface Router
{
    /**
     * todo [dispatch description]
     *
     * @param  Request $request
     *
     * @return Router
     */
    public function dispatch(Request $request): Router;

}
