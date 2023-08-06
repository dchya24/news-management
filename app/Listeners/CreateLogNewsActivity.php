<?php

namespace App\Listeners;

use App\Events\NewsActivity;
use App\Models\Log as LogModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CreateLogNewsActivity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewsActivity $event): void
    {
        $data = [
            'user_id' => $event->user_id,
            'news_id' => $event->news_id
        ];

        $json = json_encode($data);

        LogModel::insert([
            'description' => $event->desc,
            'data' => $json,
            'created_at' => now()
        ]);

        Log::info($event->desc, [$json]);
    }
}
