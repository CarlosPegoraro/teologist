<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
{
    use HandlesAuthorization;

    /**
     * Permite que admins façam qualquer coisa.
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('admin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('author');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Blog $blog): bool
    {
        // Permite se o usuário for o autor do blog.
        // Assumindo que o Author tem um user_id relacionado.
        return $user->id === $blog->author->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Blog $blog): bool
    {
        // Apenas supervisores (e admins, via before()) podem deletar.
        return $user->hasRole('supervisor');
    }
}
