<?php

namespace Emailables;

/**
 * Interface EmailAble
 *
 * @package models\emails
 */
interface Emailable
{
    /**
     * @return string
     */
    public function __toString();

    /**
     * @return string
     */
    public function getSubject();

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return array ['jsmith@test.com'=>'John Smith']
     */
    public function getRecipients();

    /**
     * @return array ['jsmith@test.com'=>'John Smith']
     */
    public function getSender();

    /**
     * @return array ['jsmith@test.com'=>'John Smith']
     */
    public function getReplyTo();

    /**
     * @param Attachable $attachment
     */
    public function addAttachment(Attachable $attachment);

    /**
     * @return Attachable[]
     */
    public function getAttachments();
}