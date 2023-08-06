<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $user_id, 
        public int $news_id, 
        public string $comment
    )
    { }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Comment::insert([
            'user_id' => $this->user_id,
            'news_id' => $this->news_id,
            'comment' => $this->comment,
            'created_at' => now()
        ]);
    }
}
