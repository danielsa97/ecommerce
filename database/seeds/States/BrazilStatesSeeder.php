<?php

use App\Models\Nation;
use App\Models\State;
use Illuminate\Database\Seeder;

class BrazilStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['Acre', 'AC'],
            ['Alagoas', 'AL'],
            ['Amazonas', 'AM'],
            ['Amapá', 'AP'],
            ['Bahia', 'BA'],
            ['Ceará', 'CE'],
            ['Distrito Federal', 'DF'],
            ['Espírito Santo', 'ES'],
            ['Goiás', 'GO'],
            ['Maranhão', 'MA'],
            ['Minas Gerais', 'MG'],
            ['Mato Grosso do Sul', 'MS'],
            ['Mato Grosso', 'MT'],
            ['Pará', 'PA'],
            ['Paraíba', 'PB'],
            ['Pernambuco', 'PE'],
            ['Piauí', 'PI'],
            ['Paraná', 'PR'],
            ['Rio de Janeiro', 'RJ'],
            ['Rio Grande do Norte', 'RN'],
            ['Rondônia', 'RO'],
            ['Roraima', 'RR'],
            ['Rio Grande do Sul', 'RS'],
            ['Santa Catarina', 'SC'],
            ['Sergipe', 'SE'],
            ['São Paulo', 'SP'],
            ['Tocantins', 'TO']
        ];

        $brazilId = Nation::query()->where('prefix', 'BR')->first()->id;
        foreach ($states as $state) {
            State::query()->firstOrCreate([
                'name' => $state[0],
                'prefix' => $state[1],
                'nation_id' => $brazilId
            ]);
        }
    }
}
