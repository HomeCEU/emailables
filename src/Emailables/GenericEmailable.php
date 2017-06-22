<?php

namespace Emailables;

final class GenericEmailable implements Emailable
{
    /** @var string */
    protected $subject;
    /** @var array */
    protected $recipients;
    /** @var array */
    protected $replyTo;
    /** @var array */
    protected $sender;
    /** @var string */
    protected $body;
    /** @var array */
    protected $attachments = [];
    /** @var string */
    protected $rawJson;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->rawJson;
    }

    private function __construct($json)
    {
        $this->rawJson = $json;

        $jsonArray        = json_decode($json, true);
        $this->subject    = $jsonArray['subject'];
        $this->sender     = $jsonArray['from'];
        $this->recipients = $jsonArray['to'];
        $this->replyTo    = $jsonArray['replyTo'];
        $this->body       = $jsonArray['html'];

        foreach ($jsonArray['attachments'] as $attachment) {
            $this->attachments[] = json_decode($attachment, true);
        }
    }

    public static function createFromJson($json)
    {
        return new self($json);
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array ['jsmith@test.com'=>'John Smith']
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @return array ['jsmith@test.com'=>'John Smith']
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return array ['jsmith@test.com'=>'John Smith']
     */
    public function getReplyTo()
    {
        return $this->replyTo;
    }

    /**
     * @param \HomeCEU\Email\Attachable $attachment
     */
    public function addAttachment(Attachable $attachment)
    {
        $this->attachments[] = $attachment;
    }

    /**
     * @return Attachable[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
}