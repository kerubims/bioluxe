<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\ProductionBatch;
use App\Models\User;
use App\Notifications\HarvestReminderNotification;
use Carbon\Carbon;

#[Signature('app:check-harvest-deadline')]
#[Description('Cek batch produksi yang mendekati masa panen dan kirim notifikasi ke staff')]
class CheckHarvestDeadline extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for batches approaching harvest...');

        // Ambil semua batch yang sedang fermentasi
        $batches = ProductionBatch::where('status', 'fermentasi')
            ->whereNotNull('estimated_harvest')
            ->get();

        $targetUsers = User::role(['admin', 'staff_produksi'])->get();
        
        $notifiedCount = 0;

        foreach ($batches as $batch) {
            $harvestDate = Carbon::parse($batch->estimated_harvest)->startOfDay();
            $today = Carbon::now()->startOfDay();
            
            $daysDiff = $today->diffInDays($harvestDate, false); // false agar bisa negatif jika sudah lewat

            // Jika hari H, H-1, H-2, atau H-3
            if ($daysDiff >= 0 && $daysDiff <= 3) {
                foreach ($targetUsers as $user) {
                    $user->notify(new HarvestReminderNotification($batch, $daysDiff));
                }
                $notifiedCount++;
            }
        }

        $this->info("Harvest reminder check complete. Sent notifications for {$notifiedCount} batches.");
    }
}
