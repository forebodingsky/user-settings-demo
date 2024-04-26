<?php

namespace Database\Seeders;

use App\Models\ConfirmationMethod;
use Illuminate\Database\Seeder;

class ConfirmationMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultConfirmationMethodsData = collect(ConfirmationMethod::DEFAULT_METHODS)
            ->reduce(function (array $carry, string $name, string $key) {
                $carry[] = [
                    'key'  => $key,
                    'name' => $name,
                ];
                return $carry;
            }, []);
        ConfirmationMethod::insert($defaultConfirmationMethodsData);
    }
}
