<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Job extends Model
{
    use HasFactory;

    public static array $experience = [
        "entry",
        "intermediate",
        "senior"
    ];

    public static array $category = [
        "IT",
        "finance",
        "sales",
        "marketing"
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filters): Builder|QueryBuilder
    {

        // filters['x'] ?? null is a safety check in case filters['x'] is not set
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            // wrapping in a where function is equivalent to enclosing the resulting SQL in paranthesis
            // check title and description for search term
            $query->where(function ($query) use ($search) {
                $query->where("title", "like", "%" . $search . "%")
                    ->orWhere("description", "like", "%" . $search . "%")
                    // Search within a nested relationship with whereHas
                    ->orWhereHas('employer', function ($query) use ($search) {
                        $query->where("company_name", "like", "%" . $search . "%");
                    });
            });
            // AND check salary range
        })->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
            $query->where("salary", '>=', $minSalary);
        })->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
            $query->where("salary", '<=', $maxSalary);
            // And check experience level
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where("experience", $experience);
            // And check category of job
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where("category", $category);
        });
    }
}
