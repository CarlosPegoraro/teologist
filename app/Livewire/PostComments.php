<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PostComments extends Component
{
    public Post $post;

    #[Rule('required|string|max:5000')]
    public string $newComment = '';

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    #[Computed]
    public function comments(): Collection
    {
        // Usamos um 'fresh()' para garantir que sempre pegamos os dados mais recentes do BD
        return $this->post->comments()->with('user')->latest()->get();
    }

    public function addComment(): void
    {
        $this->validate();

        $this->post->comments()->create([
            'content' => $this->newComment,
            'user_id' => auth()->id(),
        ]);

        // Reseta o campo do formulário e força a re-renderização da lista de comentários
        $this->reset('newComment');
        unset($this->comments);

        // Dispara uma notificação (opcional, mas bom para UX)
        $this->dispatch('comment-added', 'Seu comentário foi publicado!');
    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
