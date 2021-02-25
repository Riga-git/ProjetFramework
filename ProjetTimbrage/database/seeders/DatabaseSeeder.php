<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Grade;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // \App\Models\User::factory(10)->create();

      Department::create([
        'user_id' => null,
        'name' => 'Soft',
      ]);

      Department::create([
        'user_id' => null,
        'name' => 'Mechanics',
      ]);

      Department::create([
        'user_id' => null,
        'name' => 'Human Resouces',
      ]);

      Department::create([
        'user_id' => null,
        'name' => 'Purchase',
      ]);

      Grade::create([
        'name' => 'user',
        'can_manage_users' => false,
        'can_manage_departments' => false,
        'can_manage_clockings' => true,
        'can_manage_projects' => false,
      ]);

      Grade::create([
        'name' => 'manager',
        'can_manage_users' => false,
        'can_manage_departments' => false,
        'can_manage_clockings' => true,
        'can_manage_projects' => true,
      ]);

      Grade::create([
        'name' => 'hr',
        'can_manage_users' => true,
        'can_manage_departments' => true,
        'can_manage_clockings' => true,
        'can_manage_projects' => false,
      ]);

      User::create([
        'firstName' => 'Jérôme',
        'lastName' => 'Garo',
        'email' => 'jerome.garo@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'department_id' => 1,
        'grade_id' => 1,
      ]);

      User::create([
        'firstName' => 'Luca',
        'lastName' => 'Rigazzi',
        'email' => 'luca.rigazzi@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'department_id' => 1,
        'grade_id' => 1,
      ]);

      User::create([
        'department_id' => 3,
        'firstName' => 'Human',
        'lastName' => 'Resources',
        'email' => 'hr@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'grade_id' => 2,
      ]);

      User::create([
        'department_id' => 2,
        'firstName' => 'J-P',
        'lastName' => 'Meca',
        'email' => 'jp.meca@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'grade_id' => 3,
      ]);

      User::create([
        'department_id' => 4,
        'firstName' => 'J-F',
        'lastName' => 'Purchase',
        'email' => 'jf.purchase@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
        'grade_id' => 2,
      ]);

    }
}
