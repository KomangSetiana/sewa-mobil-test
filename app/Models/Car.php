<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand', 'model', 'license_plate', 'daily_rate', 'is_available'];


    public function scopeFilter($query, $request)
    {
        $query->when($request->search, function ($query) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($query) use ($searchTerm) {
                $query->where('brand', 'like', $searchTerm)
                    ->orWhere('model', 'like', $searchTerm)
                    ->orWhere('license_plate', 'like', $searchTerm)
                    ->orWhere('is_available', 'like', $searchTerm);
            });
        });
    }
}
