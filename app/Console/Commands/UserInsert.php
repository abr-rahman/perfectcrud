<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::insert([
            ['name' => 'Developer', 'email' => 'mdabdurrahman542@gmail.com', 'password' => bcrypt('password2023ab')],
        ]);
    }
}
