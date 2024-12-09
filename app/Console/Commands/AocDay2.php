<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AocDay2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aoc:day:2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reports = $this->reports();

        foreach ($reports as $levels) {
            $level = $this->is_safe($levels);
            dump($level);
        }

    }

    private function reports()
    {
        $reports = file_get_contents(storage_path('puzzles/day2-test.txt'));

        $reports = explode("\n", $reports);

        $reports = array_filter($reports);

        $reports = array_map(fn ($line): array => explode(' ', $line), $reports);

        return $reports;

    }

    private function is_safe(array $level): bool
    {
        $prev = $level[0];

        foreach ($level as $i) {

            dump((($i+3) >= $prev), $i, ($i+3), $prev);

            if ($i < $prev || ($i+3) <= $prev) {
                return false;
            }
            $prev = $i;
        }

        // dump($level);

        return true;
    }

    private function distance(int $start, int $end, $distance): int
    {
        return abs($start - $end);
    }
}
