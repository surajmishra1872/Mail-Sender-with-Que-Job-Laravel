<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $name,$email;
    public function __construct($email,$name)
    {
        $this->email=$email;
        $this->name=$name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
            Mail::to( $this->email)->send(new WelcomeMail($this->name));     //This is first methods
    }
}
