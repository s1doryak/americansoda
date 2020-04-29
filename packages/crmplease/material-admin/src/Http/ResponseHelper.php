<?php

namespace Crmplease\MaterialAdmin\Http;

/**
 * Response helper class.
 *
 * @package Crmplease\MaterialAdmin\Http
 */
class ResponseHelper
{
    /**
     * Current action.
     *
     * @var string
     */
    private $action;

    /**
     * Determines whether user must be returned back.
     *
     * @var bool
     */
    private $returns = false;

    /**
     * Additional response data.
     *
     * @var array
     */
    private $data = [];

    /**
     * Additional response message.
     *
     * @var array
     */
    private $message;

    /**
     * Custom response URL.
     *
     * @var string
     */
    private $url;

    /**
     * ResponseHelper constructor.
     *
     * @param $action
     */
    public function __construct($action)
    {
        $this->action = $action;
    }

    /**
     * Returns current action.
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param boolean $returns
     *
     * @return $this
     */
    public function returnBack($returns = true)
    {
        $this->returns = $returns;

        return $this;
    }

    /**
     * @return boolean
     */
    public function willReturnBack()
    {
        return $this->returns;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     *
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasData()
    {
        return count($this->data) > 0;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return boolean
     */
    public function hasMessage()
    {
        return ! empty($this->message);
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param \Throwable $e
     *
     * @return $this
     */
    public function setThrowable(\Throwable $e)
    {
        $this->data = array_merge(
            $this->data,
            [
                'message' => $e->getMessage(),
                'code'    => $e->getCode(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTrace(),
            ]
        );

        return $this;
    }
}
