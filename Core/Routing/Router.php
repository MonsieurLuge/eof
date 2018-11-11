<?php

namespace EOF\Routing;

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
