<div class="mt-16">
    {{-- New Comment Form --}}
    @auth
        <div class="mb-12">
            <form wire:submit="addComment">
                <h2 class="text-2xl font-bold text-foreground mb-4">Participe da discussão</h2>
                <div>
                    <textarea wire:model="newComment" rows="4" class="block w-full bg-background/50 border-border rounded-md text-foreground placeholder:text-muted-foreground focus:ring-2 focus:ring-inset focus:ring-teal-500 @error('newComment') border-red-500 @enderror p-5" placeholder="Escreva seu comentário..."></textarea>
                    @error('newComment')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="group inline-flex items-center justify-center bg-primary hover:bg-teal-600 text-foreground font-semibold px-6 h-10 rounded-lg shadow-lg shadow-teal-500/20 transition-all">
                        <span wire:loading.remove wire:target="addComment">Publicar Comentário</span>
                        <span wire:loading wire:target="addComment">Publicando...</span>
                    </button>
                </div>
            </form>
        </div>
    @endauth

    {{-- Comments List --}}
    <div>
        <h2 class="text-2xl font-bold text-foreground mb-6">{{ $this->comments->count() }} {{ Str::plural('Comentário', $this->comments->count()) }}</h2>
        <div class="space-y-8">
            @forelse($this->comments as $comment)
                <div class="flex items-start gap-4 animate-fade-in-up" wire:key="{{ $comment->id }}">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&size=40&background=1f2937&color=9ca3af" alt="Avatar de {{ $comment->user->name }}" class="w-10 h-10 rounded-full flex-shrink-0 mt-1">
                    <div class="flex-1 bg-card/30 rounded-lg p-4 border border-border/30">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-semibold text-foreground">{{ $comment->user->name }}</p>
                            <p class="text-xs text-muted-foreground">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="text-gray-300">
                            {!! nl2br(e($comment->content)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-muted-foreground">
                    <p>Nenhum comentário ainda. Seja o primeiro a responder!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
