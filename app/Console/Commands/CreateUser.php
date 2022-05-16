<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user with command';

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
        $rolesOptions = Role::all()->pluck('name')->toArray();
        if(!count($rolesOptions)){
            $this->info('Please create at least one role before user creating.');
            return 0;
        }
        $roleNames = $this->choice('Choose roles of the user ?', $rolesOptions, null, null, true);
        $roles = Role::whereIn('name', $roleNames)->get()->pluck('id')->toArray();

        $name = $this->ask(
            'What should be full name of the user ?'
        );

        $email = $this->ask(
            'What should be the email of the user ?'
        );

        $password = $this->secret(
            'What should be the password of the user ?'
        );

        $validator = Validator::make(
            [
                'name' => $name,
                'roles' => $roleNames,
                'email' => $email,
                'password' => $password
            ],
            [
                'name' => ['required', 'unique:users,name'],
                'roles' => ['required', 'array'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:6'],
            ]
        );

        if ($validator->fails()) {
            $this->info('User not created. See error messages below:');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password)
        ]);

        if($user){
           $user->roles()->sync($roles);
        }
        $this->info('New User created successfully.');
        return 0;
    }
}
