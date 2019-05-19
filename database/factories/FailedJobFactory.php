<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\FailedJob::class, function (Faker\Generator $faker) {

    $connection = $faker->randomElement([
        'database',
        'redis',
        'sync',
        'sqs'
    ]);

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

    $exception = "Illuminate\Queue\MaxAttemptsExceededException: $jobName has been attempted too many times or run too long. The job may have previously timed out. in /data/vendor/laravel/framework/src/Illuminate/Queue/Worker.php:405
Stack trace:
#0 /data/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(321): Illuminate\Queue\Worker->markJobAsFailedIfAlreadyExceedsMaxAttempts('database', Object(Illuminate\Queue\Jobs\DatabaseJob), 5)
#1 /data/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(277): Illuminate\Queue\Worker->process('database', Object(Illuminate\Queue\Jobs\DatabaseJob), Object(Illuminate\Queue\WorkerOptions))
#2 /data/vendor/laravel/framework/src/Illuminate/Queue/Worker.php(230): Illuminate\Queue\Worker->runJob(Object(Illuminate\Queue\Jobs\DatabaseJob), 'database', Object(Illuminate\Queue\WorkerOptions))
#3 /data/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(102): Illuminate\Queue\Worker->runNextJob('database', 'default', Object(Illuminate\Queue\WorkerOptions))
#4 /data/vendor/laravel/framework/src/Illuminate/Queue/Console/WorkCommand.php(86): Illuminate\Queue\Console\WorkCommand->runWorker('database', 'default')
#5 [internal function]: Illuminate\Queue\Console\WorkCommand->handle()
#6 /data/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(32): call_user_func_array(Array, Array)
#7 /data/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(90): Illuminate\Container\BoundMethod::Illuminate\Container\{closure}()
#8 /data/vendor/laravel/framework/src/Illuminate/Container/BoundMethod.php(34): Illuminate\Container\BoundMethod::callBoundMethod(Object(Illuminate\Foundation\Application), Array, Object(Closure))
#9 /data/vendor/laravel/framework/src/Illuminate/Container/Container.php(576): Illuminate\Container\BoundMethod::call(Object(Illuminate\Foundation\Application), Array, Array, NULL)
#10 /data/vendor/laravel/framework/src/Illuminate/Console/Command.php(183): Illuminate\Container\Container->call(Array)
#11 /data/vendor/symfony/console/Command/Command.php(255): Illuminate\Console\Command->execute(Object(Symfony\Component\Console\Input\ArgvInput), Object(Illuminate\Console\OutputStyle))
#12 /data/vendor/laravel/framework/src/Illuminate/Console/Command.php(170): Symfony\Component\Console\Command\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Illuminate\Console\OutputStyle))
#13 /data/vendor/symfony/console/Application.php(908): Illuminate\Console\Command->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#14 /data/vendor/symfony/console/Application.php(269): Symfony\Component\Console\Application->doRunCommand(Object(Illuminate\Queue\Console\WorkCommand), Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#15 /data/vendor/symfony/console/Application.php(145): Symfony\Component\Console\Application->doRun(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#16 /data/vendor/laravel/framework/src/Illuminate/Console/Application.php(90): Symfony\Component\Console\Application->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#17 /data/vendor/laravel/framework/src/Illuminate/Foundation/Console/Kernel.php(133): Illuminate\Console\Application->run(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#18 /data/artisan(37): Illuminate\Foundation\Console\Kernel->handle(Object(Symfony\Component\Console\Input\ArgvInput), Object(Symfony\Component\Console\Output\ConsoleOutput))
#19 {main}";

    $failed = now()->subHours($faker->numberBetween(1, 24 * 365));

    return [
        'connection' => $connection,
        'queue' => $queue,
        'payload' => $payload,
        'exception' => $exception,
        'failed_at' => $failed,
    ];
});
