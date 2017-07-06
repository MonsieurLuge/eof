<?php

namespace EOF\HTTP\Response;

final class BaseResponse implements Response
{

    /**
     * @inheritDoc
     */
    public function send(string $content): Response
    {
        $this->sendHeaders("HTTP/1.0 200");

        $this->sendContent($content);
        return $this;
    }

    private function sendHeaders($header)
    {
        header($header);
    }

    private function sendContent($content)
    {
        echo $content;
    }

}
