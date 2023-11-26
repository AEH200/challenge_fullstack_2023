<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * An organism
 * @property string $genus
 * @property string $species
 */
class Organism extends Model
{
    use HasFactory;

    public $fillable = [ "genus", "species"];
}
