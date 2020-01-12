<?php

namespace Demo\WebApi;

final class Hello
{
    public function handle()
    {
        header('HTTP/1.0 200 OK', true, 200);

        echo '{"message": "Hello !"}';
    }
}
