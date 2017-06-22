<?php


namespace Emailables;

class BaseAttachment implements Attachable
{
    protected $fileName;
    protected $fileLocation;
    protected $contentType;

    public function __toString()
    {
        return json_encode([
            'FileName'     => $this->getFileName(),
            'FileLocation' => $this->getFileLocation(),
            'ContentType'  => $this->getContentType()
        ]);
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

    /**
     * @param string $fileLocation
     *
     * @return $this
     */
    public function setFileLocation($fileLocation)
    {
        $this->fileLocation = $fileLocation;
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
    public function getFileLocation()
    {
        return $this->fileLocation;
    }
}