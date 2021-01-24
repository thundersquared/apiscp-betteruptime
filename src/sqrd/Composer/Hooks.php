<?php declare(strict_types=1);

namespace sqrd\Composer;

use Composer\Script\Event;

class Hooks
{
    const APISDIR = '/usr/local/apnscp';
    const APISCSTM = '/usr/local/apnscp/config/custom';
    public static function postUpdate(Event $event) : void
    {
        if (!is_dir(static::APISCSTM . '/apps/login/views/partials/'))
        {
            mkdir(static::APISCSTM . '/apps/login/views/partials/', 0755, true);
        }

        copy('src/sqrd/ApisCP/Extensions/views/status.blade.php', static::APISCSTM . '/apps/login/views/partials/status.blade.php');
        copy('src/sqrd/ApisCP/Extensions/BetterUptime.php', static::APISCSTM . '/BetterUptime.php');

        exec(sprintf('cd %s ; composer dumpautoload -o', static::APISDIR));

        echo "You're done!" . PHP_EOL;
    }
}
