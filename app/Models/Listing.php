<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ["company", "title", "location", "email", "website", "tags", "description", "logo", "user_id"];

    public function scopeFilter($query, array $filters)
    {
        if ($filters["tag"] ?? false) {
            $query->where("tags", "LIKE", "%" . $filters["tag"] . "%");
        }

        if ($filters["search"] ?? false) {
            $query
                ->where("title", "LIKE", "%" . $filters["search"] . "%")
                ->orWhere("description", "LIKE", "%" . $filters["search"] . "%")
                ->orWhere("tags", "LIKE", "%" . $filters["search"] . "%");
        }
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
