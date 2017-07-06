<?php


namespace Emailables;


final class GenericAttachable implements Attachable
{
    private $fileName;
    private $contentType;
    private $content;
    private $isBase64Encoded;

    private function __construct($json)
    {
        $jsonArray             = json_decode($json, true);
        $this->fileName        = $jsonArray['fileName'];
        $this->contentType     = $jsonArray['contentType'];
        $this->content         = $jsonArray['content'];
        $this->isBase64Encoded = $jsonArray['isBase64Encoded'];
    }

    /**
     * @param string $json
     *
     * @return GenericAttachable
     */
    public static function createFromJson($json)
    {
        return new self($json);
    }

    /**
     * @return string
     */
    public function isBase64Encoded()
    {
        return $this->isBase64Encoded();
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->getFileName();
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->getContentType();
    }

    /**
     * @return string file location or base64 encoded
     */
    public function getContent()
    {
        return $this->getContent();
    }
}