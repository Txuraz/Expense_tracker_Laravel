<?php

namespace Database\Seeders;

use App\Models\IncomeAndExpense;
use App\Models\User;
use Illuminate\Database\Seeder;


class IncomeAndExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'password' => bcrypt('password'),
            ]);

            $incomeExpenseData = [];

            for ($j = 0; $j < 5; $j++) {
                $incomeExpenseData[] = [
                    'user_id' => $user->id,
                    'amount' => rand(1000, 9999),
                    'category' => $this->getRandomWord(),
                    'type' => rand(0, 1) ? 'income' : 'expenses',
                    'date' => now()->subDays(rand(1, 30)),
                ];
            }

            IncomeAndExpense::insert($incomeExpenseData);
        }
    }

    private function getRandomWord()
    {
        $words = ['Salary', 'Rent', 'Groceries', 'Utilities', 'Entertainment', 'Healthcare', 'Investment', 'Other'];
        return $words[array_rand($words)];
    }

}
