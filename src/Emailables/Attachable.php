<?php


namespace Emailables;


interface Attachable
{
    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return string
     */
    public function getFileLocation();
}