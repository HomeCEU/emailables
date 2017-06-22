<?php

namespace Emailables;

/**
 * Class BaseEmail
 *
 * @package models\emails
 */
abstract class BaseEmail implements Emailable
{
    /** @var Attachable[] */
    protected $attachments = [];

    /**
     * @param Attachable $attachment
     *
     * @return $this
     */
    public function addAttachment(Attachable $attachment)
    {
        $this->attachments[] = $attachment;
        return $this;
    }

    /**
     * @return Attachable[]
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * @return string|null
     */
    public function getAttachmentsAsArrayOfStrings()
    {
        return array_map(function ($attachment) {
            return (string) $attachment;
        }, $this->attachments);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->getToStringArray());
    }

    /**
     * Build array for converting to toString
     * Adding into a second method so children can add to it
     *
     * @return array
     */
    protected function getToStringArray()
    {
        return [
            'to'          => $this->getRecipients(),
            'from'        => $this->getSender(),
            'replyTo'     => $this->getReplyTo(),
            'subject'     => $this->getSubject(),
            'html'        => $this->getBody(),
            'attachments' => $this->getAttachmentsAsArrayOfStrings()
        ];
    }

    /**
     * Wrap an html string in a simple html body for emailing
     *
     * @param $body
     *
     * @return string
     */
    protected function getHtmlWrappedBody($body)
    {
        $html = <<<HTML
     <!DOCTYPE html>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <title></title>
        </head>
        <body>
            <div style="margin:auto;">$body</div>
        </body>
    </html>
HTML;
        return $html;
    }
}
