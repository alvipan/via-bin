<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'Kilogram', 'symbol' => 'kg'],
            ['name' => 'Gram', 'symbol' => 'g'],
            ['name' => 'Piece', 'symbol' => 'pcs'],
        ])->each(fn (array $unit): Unit => Unit::updateOrCreate(
            ['symbol' => $unit['symbol']],
            $unit
        ));
    }
}
