<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use RdKafka\Conf;
use RdKafka\Consumer;

class KafkaConsumerCommand extends Command
{
    protected $signature = 'kafka:consumer';

    protected $description = 'Kafka consumer';

    public function handle () {
        $conf = new Conf();
        $conf->set('log_level', LOG_DEBUG);
        // $conf->set('debug', 'all');
        $rk = new Consumer($conf);
        $rk->addBrokers("kafka:9092");

        $topic = $rk->newTopic("test22");

        // The first argument is the partition to consume from.
        // The second argument is the offset at which to start consumption. Valid values
        // are: RD_KAFKA_OFFSET_BEGINNING, RD_KAFKA_OFFSET_END, RD_KAFKA_OFFSET_STORED.
        $topic->consumeStart(0, RD_KAFKA_OFFSET_BEGINNING);

        $this->info('Started listening');

        while (true) {
            // The first argument is the partition (again).
            // The second argument is the timeout.
            $msg = $topic->consume(0, 1000);
            if (null === $msg) {
                continue;
            } elseif ($msg->err) {
                echo 'err :' . $msg->errstr() . " : still listening", "\n";
                continue;
            } else {
                echo $msg->payload, "\n";
            }
        }
    }
}
