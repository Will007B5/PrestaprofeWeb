<?php

namespace App\Console\Commands;

use App\Jobs\jobExample;
use App\Models\Loan;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Prueba;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyLoans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Loans:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtiene los pagos de el dia actual';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $end = Carbon::now();
        $start = Carbon::now()->subYear(3);
        $loans=Loan::select('*')->whereBetween('accepted_date',[$start, $end])->get();
        Log::info($start.' == '.$end);
        $job=dispatch(new jobExample())->delay(20);
        Log::alert(Carbon::now()->addSeconds(10));
    }
}
