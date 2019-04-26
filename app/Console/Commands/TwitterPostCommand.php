<?php

namespace App\Console\Commands;

use App\Models\Tweet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Thujohn\Twitter\Facades\Twitter;

class TwitterPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'twitter:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pick a random word and post a tweet';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->warn('Posting tweet');
            // Pick a random line in file and select it as word.
            $file = file(resource_path('dictionary.txt'));

            do {
                $word = $this->randomWord($file);
            } while ($exists = Tweet::query()->where('word', $word)->exists());

            $tweet = Twitter::postTweet(['status' => $word]);

            Tweet::query()->create([
                'word'       => $word,
                'twitter_id' => $tweet->id_str,
            ]);

            $this->info('Posted tweet: ' . $word);
        } catch (\Exception $exception) {
            $this->error('Failed posting tweet, read logs for more details');
            $this->error($exception->getMessage());

            Log::critical('failed posting tweet', [
                'exception_code'    => $exception->getCode(),
                'exception_message' => $exception->getMessage(),
                'exception_trace'   => $exception->getTraceAsString(),
            ]);
        }
    }

    protected function randomWord(array $file): string
    {
        return "Bat-{$file[mt_rand(0, count($file) - 1)]}";
    }
}
