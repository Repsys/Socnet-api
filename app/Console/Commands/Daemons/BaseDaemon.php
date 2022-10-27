<?php

namespace App\Console\Commands\Daemons;

use App\Constants\TimeConstants;
use App\Helpers\Common\ConsolePrinter;
use Carbon\CarbonInterval;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

abstract class BaseDaemon extends Command
{
    use ConsolePrinter;

    /**
     * Время сна демона
     * @var int
     */
    protected int $sleepTime = TimeConstants::ONE_MINUTE_IN_SECONDS;

    public function handle(): int
    {
        try {
            CarbonInterval::setLocale('en');
            $sleepTimeMsg = Str::upper(CarbonInterval::seconds($this->sleepTime)->cascade()->forHumans());
            $this->init();

            $this->log('THE DAEMON HAS STARTED.');
            $this->printBoldSeparator();
            while (true) {

                $this->exec();

                $this->log('DAEMON WENT TO SLEEP FOR ' . $sleepTimeMsg);
                $this->printBoldSeparator();
                sleep($this->sleepTime);
            }
        } catch (Exception $e) {
            $this->log('SOMETHING WENT WRONG.');
            $this->log('<fg=red>.' . $e . '<fg=red>');
            return CommandAlias::FAILURE;
        }
    }

    /**
     * Инициализация демона перед вызовом start()
     */
    public function init()
    {
    }

    /**
     * Выполнение основной логики демона
     */
    abstract public function exec();

}
