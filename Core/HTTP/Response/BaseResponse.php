<?php

namespace EOF\HTTP\Response;

final class BaseResponse implements Response
{

    /**
     * @inheritDoc
     */
    public function send($header, $content): Response
    {
        $this->sendHeaders($header);

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
