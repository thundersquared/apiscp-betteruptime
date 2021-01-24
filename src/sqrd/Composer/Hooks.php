<?php declare(strict_types=1);

namespace sqrd\Composer;

use Composer\Script\Event;

class Hooks
{
    const APISDIR = '/usr/local/apnscp/config/custom';
    public static function postUpdate(Event $event) : void
    {
        mkdir(static::APISDIR . '/apps/login/views/partials/', 755, true);
        copy('src/sqrd/ApisCP/Extensions/views/status.blade.php', static::APISDIR . '/apps/login/views/partials/status.blade.php');
        copy('src/sqrd/ApisCP/Extensions/BetterUptime.php', static::APISDIR . '/BetterUptime.php');
        echo "You're done!";
    }
}
