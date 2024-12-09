<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AocDay1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:day:1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'AOC Day 1';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $leftList = $this->locations(0); // 0 = left list.
        $rightList = $this->locations(1); // 1 = right list.

        $distance = [];

        sort($leftList);
        sort($rightList);

        $rightListCount = array_count_values($rightList);

        for ($x = 0; $x < count($leftList); $x++) {
            $distance[] = [
                $leftList[$x],
                $rightList[$x],
                abs($rightList[$x] - $leftList[$x]),
                isset($rightListCount[$leftList[$x]]) ? $leftList[$x] * $rightListCount[$leftList[$x]] : 0,
            ];
        }

        $this->table(
            ['Left List', 'Right List', 'Distance', 'Left Similarity Score'],
            $distance
        );

        $this->info('The sum of the distances is: <options=bold;fg=red>'.array_sum(array_column($distance, 2)).'</>');

        $this->info('The sum of the similarity score is: <options=bold;fg=red>'.array_sum(array_column($distance, 3)).'</>');
    }

    private function locations($location)
    {
        $numbers = file_get_contents(storage_path('puzzles/day1.txt'));

        $numbers = explode("\n", $numbers);

        $numbers = array_filter($numbers);

        $numbers = array_map(
            function ($value) use ($location) {
                $value = explode('   ', $value);

                return (int) $value[$location];
            }, $numbers
        );

        return $numbers;

    }
}
