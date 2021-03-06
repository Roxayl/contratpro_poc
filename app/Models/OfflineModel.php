<?php

namespace App\Models;

abstract class OfflineModel
{
    public function mapFromArray(array $data)
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
