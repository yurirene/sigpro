<?php

namespace Database\Seeders;

use App\Models\Nivel;
use App\Models\Perfil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfis = [
            1 => [
                'nome' => 'Master',
                'name' => 'master'
            ],
            2 => [
                'nome' => 'Funcionários',
                'name' => 'funcionarios'
            ],
            3 => [
                'nome' => 'Clientes',
                'name' => 'clientes'
            ],
        ];

        DB::beginTransaction();
        try {
            foreach ($perfis as $id => $perfil) {
                Perfil::updateOrCreate(['id' => $id], [
                    'id' => $id,
                    'nome' => $perfil['nome'],
                    'name' => $perfil['name']
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
