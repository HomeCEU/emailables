<?php


namespace Emailables;


interface Attachable
{
    /**
     * @return string
     */
    public function isBase64Encoded();

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return string file location or base64 encoded
     */
    public function getContent();
}