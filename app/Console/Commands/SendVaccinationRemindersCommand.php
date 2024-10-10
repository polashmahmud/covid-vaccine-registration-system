<?php

namespace App\Console\Commands;

use App\Jobs\SendVaccinationReminderJob;
use App\Models\Registration;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendVaccinationRemindersCommand extends Command
{
    protected $signature = 'send:vaccination-reminders';

    protected $description = 'Send vaccination reminder emails the night before the scheduled date.';

    public function handle(): void
    {
        $tomorrow = Carbon::tomorrow()->format('Y-m-d');

        $registrations = Registration::with(['user', 'vaccineCenter'])
            ->whereDate('scheduled_date', $tomorrow)
            ->where('status', 'scheduled')
            ->get();

        foreach ($registrations as $registration) {
            SendVaccinationReminderJob::dispatch($registration);
        }

        $this->info('Vaccination reminders sent successfully.');
    }
}
