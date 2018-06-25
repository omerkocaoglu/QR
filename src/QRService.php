<?php

namespace OmerKocaoglu\QR;

use Endroid\QrCode\QrCode;

class QRService
{
    /** @var QrCode */
    private $qr_code_instance = null;
    /** @var string */
    private $content = null;
    /** @var int */
    private $size = 0;
    /** @var string */
    private $error_correction_level = null;

    public function __construct()
    {
        if ($this->qr_code_instance === null) {
            $this->qr_code_instance = new QrCode();
            header('Content-Type: ' . $this->qr_code_instance->getContentType());
        }

        return $this->qr_code_instance;
    }

    /**
     * @param string $content
     * @return QRService
     */
    public function setContent($content)
    {
        $this->content = $content;
        $this->qr_code_instance->setText($this->content);
        return $this;
    }

    /**
     * @param int $size
     * @return QRService
     */
    public function setSize($size)
    {
        $this->size = $size;
        $this->qr_code_instance->setSize($this->size);
        return $this;
    }

    /**
     * @param string $correction_level
     * @return QRService
     */
    public function setErrorCorrectionLevel($correction_level)
    {
        $this->error_correction_level = $correction_level;
        $this->qr_code_instance->setErrorCorrectionLevel($this->error_correction_level);
        return $this;
    }

    /**
     * @param int $margin
     * @return QRService
     */
    public function setMargin($margin)
    {
        $this->qr_code_instance->setMargin($margin);
        return $this;
    }

    /**
     * @param int $red
     * @param int $blue
     * @param int $green
     * @param int $alpha
     * @return QRService
     */
    public function setForegroundColor($red, $blue, $green, $alpha)
    {
        $this->qr_code_instance->setForegroundColor(['r' => $red, 'b' => $blue, 'g' => $green, 'a' => $alpha]);
        return $this;
    }

    /**
     * @param int $red
     * @param int $blue
     * @param int $green
     * @param int $alpha
     * @return QRService
     */
    public function setBackgroundColor($red, $blue, $green, $alpha)
    {
        $this->qr_code_instance->setBackgroundColor(['r' => $red, 'b' => $blue, 'g' => $green, 'a' => $alpha]);
        return $this;
    }

    /**
     * @return string
     */
    public function writeBase64Format()
    {
        $image = $this->qr_code_instance->writeString();
        return "data:image/png;base64," . base64_encode($image);
    }

    /**
     * @param string $path
     */
    public function writeToFile($path)
    {
        $this->qr_code_instance->writeFile($path);
    }
}
