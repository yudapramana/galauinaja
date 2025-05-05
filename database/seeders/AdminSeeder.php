<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nipadmins = [
            '199407292022031002', // Yud
            '198005152005011007', // Jarmil
            '198810252023211021', // Fauzhi
            '197505152005012003', // Anna
            '198305042014111002', // Koko
            '199307222023211014', // Azka
            '198006222014112002', // Sri
            '198605052023212065', // Ija
            '197904092023212012', // Amak
            '199009152023211019', // Kiki
        ];

        $users = User::whereIn('username', $nipadmins)->get();

        foreach ($users as $key => $user) {
            if($user->username == '199407292022031002') {
                $user->update([
                    'role' => App\Enums\RoleType::SUPERADMIN->value,
                    'can_multiple_role' => true
                ]);
        
                $user->roles()->syncWithoutDetaching([
                    Role::where('name', 'SUPERADMIN')->first()->id,
                    Role::where('name', 'ADMIN')->first()->id,
                    Role::where('name', 'REVIEWER')->first()->id,
                ]);
            } else {
                $user->update([
                    'role' => App\Enums\RoleType::REVIEWER->value,
                    'can_multiple_role' => true
                ]);
        
                $user->roles()->syncWithoutDetaching([
                    Role::where('name', 'REVIEWER')->first()->id,
                ]);
            }
            
            
        }

        
    }
}
