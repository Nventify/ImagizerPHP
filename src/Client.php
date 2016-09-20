<?php

namespace Imagizer;

class Client
{
    const DEFAULT_QUALITY = 90;
    const DEFAULT_DPR = 1.0;
    const DEFAULT_IMAGIZER_HOST = "demo.imagizercdn.com";

    private $useHttps;
    private $imagizerHost;
    private $originImageHost;
    private $dpr;
    private $quality;
    private $format;

    /**
     * Initialize Imagizer client
     *
     * @param string $imagizerHost the hostname to the Imagizer instance (optional)
     * @param bool $useHttps whether to use https for the connection (optional)
     */
    public function __construct($imagizerHost = self::DEFAULT_IMAGIZER_HOST, $useHttps = false)
    {
        if (isset($imagizerHost)) {
            $this->imagizerHost = $imagizerHost;
        }

        $this->useHttps = $useHttps;
        $this->quality = self::DEFAULT_QUALITY;
        $this->dpr = self::DEFAULT_DPR;
    }

    /**
     * Returns an Imagizer URL with supplied params
     *
     * @param string $path the path for the url (optional)
     * @param array $params the params to add to the url (optional)
     * @return string
     */
    public function buildUrl($path, $params = [])
    {
        if (substr($path, 0, 1) != "/") {
            $path = "/" . $path;
        }

        $params = $this->addGlobalParams($params);

        $scheme = $this->useHttps ? "https" : "http";
        $url = $scheme . "://";
        $url .= $this->imagizerHost;
        $url .= $path;

        if (count($params) > 0) {
            $queryParam = http_build_query($params);
            $url .=  "?" . $queryParam;
        }

        return $url;
    }

    private function addGlobalParams(Array $params)
    {
        if (!isset($params['dpr']) && $this->dpr != self::DEFAULT_DPR) {
            $params['dpr'] = $this->dpr;
        }

        if (!isset($params['format']) && $this->format) {
            $params['format'] = $this->format;
        }

        if (!isset($params['quality']) && $this->quality != self::DEFAULT_QUALITY) {
            $params['quality'] = $this->quality;
        }

        if (isset($this->originImageHost)) {
            $params['hostname'] = $this->originImageHost;
        }

        return $params;
    }

    /**
     * Returns the origin image storage hostname
     *
     * @return string the origin image storage hostname
     */
    public function getOriginImageHost()
    {
        return $this->originImageHost;
    }

    /**
     * Sets the origin image storage host
     *
     * @param $originImageHost string the origin image storage hostname
     */
    public function setOriginImageHost($originImageHost)
    {
        $this->originImageHost = $originImageHost;
    }

    /**
     * Returns the current default device pixel ratio
     *
     * @return float $dpr the device pixel ratio
     */
    public function getDpr()
    {
        return $this->dpr;
    }

    /**
     * Set the default device pixel ratio
     *
     * @param string $dpr the device pixel ratio. Default is 1.0
     */
    public function setDpr($dpr)
    {
        $this->dpr = $dpr;
    }

    /**
     * Returns the current default image quality compression
     *
     * @return string $quality the default quality compression
     */
    public function getQuality()
    {
        return $this->quality;
    }

    /**
     * Set the default image quality compression
     *
     * @param int $quality the default quality compression 0 - 100.
     *                Default is 90
     */
    public function setQuality($quality)
    {
        $this->quality = $quality;
    }

    /**
     * Returns the current default image format
     *
     * @return string $format the default image format
     */
    public function getFormat()
    {
        return $this->format;
    }


    /**
     * Sets the default image format for imagizer to return
     *
     * @param string $format the type of image format to use
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * Returns the current Imagizer host
     *
     * @return string $imagizerHost the imagizer host current used
     */
    public function getImagizerHost()
    {
        return $this->imagizerHost;
    }

    /**
     * Sets the Imagizer host
     *
     * @param string $imagizerHost the imagizer host to use
     */
    public function setImagizerHost($imagizerHost)
    {
        $this->imagizerHost = $imagizerHost;
    }


}