<?php

namespace App\Services\Cerfa;

class CerfaConfig
{
    private \stdClass $config;

    public function loadFromFile(string $path)
    {
        $str = file_get_contents($path);
        $json = json_decode($str, false);
        $this->config = $json;
    }

    public function getConfig() : \stdClass
    {
        return $this->config;
    }
}
