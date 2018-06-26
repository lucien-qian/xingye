<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notice;
use App\User;
class SendNotice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
        private $notice;
        private $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Notice $notice,User $user)
    {
        //
        $this->user=$user;
        $this->notice=$notice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->user->addNotice($this->notice);
    }
}
