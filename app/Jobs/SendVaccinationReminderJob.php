<?php

namespace App\Jobs;

use App\Mail\VaccinationReminderMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVaccinationReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $registration;

    public function __construct($registration)
    {
        $this->registration = $registration;
    }

    public function handle(): void
    {
        Mail::to($this->registration->user->email)->send(new VaccinationReminderMail($this->registration));
    }
}
