<?php

// namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            ["name" => "admin", "email" => "admin@mail.com", "role" => "admin", "password" => Hash::make("admindkk")],
            ["name" => "p2ml", "email" => "p2ml@mail.com", "password" => Hash::make("p2ml")],
            ["name" => "p2tms", "email" => "p2tms@mail.com", "password" => Hash::make('p2tms')],
            ["name" => "p2tvz", "email" => "p2tvz@mail.com", "password" => Hash::make('p2tvz')],
            ["name" => "kia", "email" => "kia@mail.com", "password" => Hash::make('kia')],
            ["name" => "kesling", "email" => "kesling@mail.com", "password" => Hash::make('kesling')],
            ["name" => "pmgz", "email" => "pmgz@mail.com", "password" => Hash::make('pmgz')],
            ["name" => "pkpt", "email" => "pkpt@mail.com", "password" => Hash::make('pkpt')],
            ["name" => "rujukan", "email" => "rujukan@mail.com", "password" => Hash::make('rujukan')],
            ["name" => "jamkes", "email" => "jamkes@mail.com", "password" => Hash::make('jamkes')],
            ["name" => "farmakes", "email" => "farmakes@mail.com", "password" => Hash::make('farmakes')],
            ["name" => "sdmk", "email" => "sdmk@mail.com", "password" => Hash::make('sdmk')],
            ["name" => "infokes", "email" => "infokes@mail.com", "password" => Hash::make('infokes')],
            ["name" => "umpeg", "email" => "umpeg@mail.com", "password" => Hash::make('umpeg')],
            ["name" => "perencanaan", "email" => "perencanaan@mail.com", "password" => Hash::make('perencanaan')],
            ["name" => "keuangan", "email" => "keuangan@mail.com", "password" => Hash::make('keuangan')],
            ["name" => "if", "email" => "if@mail.com", "password" => Hash::make('if')],
            ["name" => "labkes", "email" => "labkes@mail.com", "password" => Hash::make('labkes')],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}