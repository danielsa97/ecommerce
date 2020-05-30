<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Geral
        $this->store('general', 'A', 'Ativo');
        $this->store('general', 'I', 'Inativo');
    }

    private function store(string $type, string $value, string $description)
    {
        Status::query()->create(compact('type', 'value', 'description'));
    }
}
