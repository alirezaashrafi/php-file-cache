<?php

class Cache
{

    /**
     * The name of the cache file
     * @var string
     */
    public $cacheDir;

    /**
     * The cache data
     * @var array
     */
    protected $data;

    /**
     * Construct or retrieve a cache of data from the given file
     * @param string $file
     */
    public function __construct($dir = 'key-value-cache2', $name = 'default')
    {
        $dir = __DIR__ . '/cache/' . $dir;

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $this->cacheDir = $dir . '/' . $name;
    }

    function __destruct()
    {
        file_put_contents($this->getFilePath(), json_encode($this->data));
    }


    private function getFilePath()
    {
        return $this->cacheDir;
    }

    public function get($key, $default = '')
    {
        if ($this->data == null && file_exists($this->getFilePath())) {
            $this->data = json_decode(file_get_contents($this->getFilePath()), true);
        }

        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return $default;
    }


    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $value;
    }

}