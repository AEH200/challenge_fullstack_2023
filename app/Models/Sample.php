<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Crops;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A sample
 * @property string $code The code to identify the sample
 */
class Sample extends Model
{
    use HasFactory;

    public function abundances(){
        return $this->hasMany(Abundance::class);
    }
    public function crops() : BelongsTo {
        //Al establecerse una relacion 1:N entre crops y samples la mejor opcion es trabajar con un Belongs To
        return $this->belongsTo(Crops::class, "crop_id", "id");
    }

}
