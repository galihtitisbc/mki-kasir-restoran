<?php

namespace Database\Factories;

use App\Models\Meja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meja>
 */
class MejaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Meja::class;
    private static $counter = 1;
    public function definition(): array
    {
        return [
            'outlet_id' => 1,
            'nomor_meja' => self::$counter++
        ];
    }
}
