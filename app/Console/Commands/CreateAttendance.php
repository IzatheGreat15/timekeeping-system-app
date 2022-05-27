<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        /* get all users from the database */
        $users = DB::table('users')->select('*')->get();

        foreach($users as $u){
            /* create time adjustments and get ID */
            $time_ID = DB::table('time_adjustments')
                       ->insertGetId([]);

            /* create an entry in the attendance for each uesr */
            DB::table('attendance')
            ->insert([
                'emp_ID'      => $u->id,
                'time_ID'     => $time_ID
            ]);
        }
    }
}
