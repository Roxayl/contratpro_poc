<?php

namespace App\Models;

abstract class OfflineModel
{
    public function mapFromArray(array $data) : void
    {
        foreach($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
