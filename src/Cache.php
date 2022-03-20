<?php

namespace AlirezaAshrafi;


class Cache
{

    /**
     * The cache data
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var string
     */
    private $file;

    /**
     * Cache constructor.
     * @param string $directory
     * @param string $file
     */
    public function __construct($directory, $file)
    {
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $this->directory = $directory;
        $this->file = $file;

        if (file_exists($this->getFilePath())) {
            $this->data = unserialize(file_get_contents($this->getFilePath()));
        }
    }


    function getFilePath()
    {
        return $this->directory . '/' . $this->file;
    }


    /**
     * save changes before close the session
     */
    function __destruct()
    {
        file_put_contents($this->getFilePath(), serialize($this->data));
    }

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $value;
    }

    public function get($key, $default = null)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return $default;
    }

    public function has($key)
    {
        return isset($this->data[$key]);
    }

    public function delete($key)
    {
        unset($this->data[$key]);

        return true;
    }

    public function getAll()
    {
        return $this->data;
    }

    public function purgeAll()
    {
        $this->data = array();

        return true;
    }
}