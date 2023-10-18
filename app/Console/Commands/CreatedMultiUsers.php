<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreatedMultiUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'app:created-multi-users {name?*} {email*} {--P|password=*}';
    protected $signature = 'app:created-multi-users {name} {email} {--P|password=password}';
//    protected $signature = 'app:created-multi-users';
//    protected $signature = 'app:created-multi-users
//                        {name?* : Username}
//                        {email : Email}
//                        {--password : password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {


//            for($i=0; $i< 3; $i++) {
//                User::create(
//                    [
//                        'name' => 'Nguyen Van' . $i,
//                        'email' => 'nguyenvan' . $i . '@gmail.com',
//                        'password' => bcrypt('password'),
//                    ]
//                );
//            }
            User::create(
                [
                    'name' => $this->argument('name'),
                    'email' => $this->argument('email'),
                    'password' => bcrypt($this->option('password')),
                ]
            );
        }catch (\Exception $e) {
            $this->error('Error' . $e->getMessage());
        }

        $this->info('Successful');
    }
}
