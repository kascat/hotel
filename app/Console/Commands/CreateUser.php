<?php

namespace App\Console\Commands;

use App\Model\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * CreateUser constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::create([
            'name' => 'Gerente',
            'email' => 'gerente@mail.com',
            'password' => bcrypt('123456'),
            'role' =>  'master'
        ]);

        $this->info("Usuário criado com sucesso!");
    }
}
