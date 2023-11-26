<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crops extends Model
{
    public $table='crops';

    public function sample(){
        return $this->hasMany(Sample::class, "crops_id", "id");
    }
}
