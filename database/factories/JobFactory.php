<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Job::class, function (Faker\Generator $faker) {

    $queue = $faker->randomElement([
        'default',
        'download',
        'process'
    ]);

    $job = $faker->word;
    $jobName = sprintf('App\\Jobs\\%s%s', studly_case($queue), studly_case($job));

    $data = new stdClass();

    $data->commandName = $jobName;
    $data->command = 'O:23:\"App\\Jobs\\ProcessPodcast\":8:{s:9:\"\u0000*\u0000carbon\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2019-05-22 22:08:49.961084\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:6:\"\u0000*\u0000job\";N;s:10:\"connection\";N;s:5:\"queue\";N;s:15:\"chainConnection\";N;s:10:\"chainQueue\";N;s:5:\"delay\";O:25:\"Illuminate\\Support\\Carbon\":3:{s:4:\"date\";s:26:\"2019-05-18 22:18:49.974782\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}s:7:\"chained\";a:0:{}}';

    $payload = new stdClass();

    $payload->displayName = $jobName;
    $payload->job = 'Illuminate\\Queue\\CallQueuedHandler@call';
    $payload->maxTries = null;
    $payload->delay = null;
    $payload->timeout = null;
    $payload->timeoutAt = null;
    $payload->data = $data;

    if ($faker->boolean) {
        $attempts = $faker->numberBetween(1, 5);
        $reserved = now()->getTimestamp();
        $available = now()->addMinutes($faker->randomElement([0, 5, 15]))->getTimestamp();
    } else {
        $attempts = 0;
        $reserved = null;
        $available = now()->getTimestamp();
    }

    $created = now()->getTimestamp();

    return [
        'queue' => $queue,
        'payload' => $payload,
        'attempts' => $attempts,
        'reserved_at' => $reserved,
        'available_at' => $available,
        'created_at' => $created,
    ];
});
