<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;
use RdKafka\Conf;
use RdKafka\Producer;

class KafkaProducerCommand extends Command
{
    protected $signature = 'kafka:producer';

    protected $description = 'Kafka Producer ';

    public function handle () {
        $conf = new Conf();
        // $conf->set('log_level', LOG_DEBUG);
        // $conf->set('debug', 'all');
        $rk = new Producer($conf);
        $rk->addBrokers("kafka:9092");

        $topic = $rk->newTopic("test22");

        for ($i = 0; $i < 10; $i++) {
            $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message " . rand(1000, 100000));
            $rk->poll(0);
        }

        while ($rk->getOutQLen() > 0) {
            $rk->poll(50);
        }

    }
}
