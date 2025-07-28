<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Request as MedicineRequest;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_no_pos'];

    public function requests()
    {
        return $this->hasMany(MedicineRequest::class);
    }
}
