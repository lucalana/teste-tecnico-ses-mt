<?php

namespace App\Models;

use App\Models\Scopes\MyTaskScope;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy([MyTaskScope::class])]
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $guarded = [];

    #[Scope]
    protected function status(Builder $query, string $status = '')
    {
        $status = empty($status) ? ['Concluída', 'Pendente'] : [$status];
        $query->whereIn('status', $status);
    }
}
