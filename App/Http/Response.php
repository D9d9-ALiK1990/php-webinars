<?php

namespace App\Http;

/**
 * Class Response
 * @package App\Http
 */
class Response {

    /**
     * @var string
     */
    private $body = '';

    private $redirectUrl = null;

    /**
     * @return null
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @param null $redirectUrl
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
        return $this;
    }

    public function redirect($url) {
        $this->redirectUrl = $url;
        header('Location: ' . $this->getRedirectUrl());
        exit;
    }

    public function __toString()
    {
        if (!is_null($this->getRedirectUrl())) {
            $this->redirect($this->getRedirectUrl());
    }
        return $this->getBody();
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body): self
    {
        $this->body = $body;
        return $this;
    }
}
