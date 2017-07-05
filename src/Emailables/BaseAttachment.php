<?php


namespace Emailables;

class BaseAttachment implements Attachable
{
    protected $fileName;
    protected $content;
    protected $contentType;
    protected $isBase64 = false;

    public function __toString()
    {
        return json_encode([
            'FileName'     => $this->getFileName(),
            'FileLocation' => $this->getFileLocation(),
            'ContentType'  => $this->getContentType()
        ]);
    }

    public function setIsBase64($trueFalse)
    {
        $this->isBase64 = $trueFalse;
        return $this;
    }

    public function isBase64Encoded()
    {
        return $this->isBase64;
    }

    /**
     * @param mixed $fileName
     *
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param string $contentType
     *
     * @return $this
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}