<?php declare(strict_types=1);

namespace sqrd\ApisCP\Extensions\BetterUptime;

class BetterUptime
{
    const STATUS_URL = MISC_SYS_STATUS;
    const STATUS_APIKEY = EXTENSIONS_BETTERUPTIME_APIKEY;
    const STATUS_PAGE = EXTENSIONS_BETTERUPTIME_STATUS_PAGE;

    public function getStatusPage(): string
    {
        return static::STATUS_URL;
    }

    public function getStatusPageID(): string
    {
        return static::STATUS_PAGE;
    }

    public function getNetworkStatus()
    {
        if (!static::STATUS_APIKEY || !static::STATUS_PAGE)
        {
            return null;
        }

        $key = "sys.status";
        $cache = \Cache_Super_Global::spawn();

        if (false !== ($status = $cache->get($key)))
        {
            return $status;
        }

        /* $url = sprintf('https://betteruptime.com/api/v2/status-pages/%d', static::STATUS_PAGE);
        $adapter = new \HTTP_Request2_Adapter_Curl();
        $req = new \HTTP_Request2($url, \HTTP_Request2::METHOD_GET, ['adapter' => $adapter]);

        $resp = $req->send();
        if ($resp->getStatus() !== 200)
        {
            return true;
        }
        $body = json_decode($resp->getBody(), true);
        $status = "Operational";
        $marker = null;
        foreach ($body['data'] as $d)
        {
            foreach ($d['enabled_components'] as $c)
            {
                $tmp = $c['status_name'];
                if ($tmp !== "Operational")
                {
                    $status = $tmp;
                    $marker = $c['description'] ? $c['description'] : $c['name'];
                }
            }
        }
        $status = array('status' => $status, 'marker' => $marker);
        $cache->set($key, $status, 300); */

        return $status;
    }

    public function textByStatus($status)
    {
        $status = str_replace(' ', '-', strtolower($status));
        switch ($status)
        {
            case 'operational':
                return 'text-success';
            case 'major-outage':
                return 'text-danger';
            case 'partial-outage':
                return 'text-warning';
            case 'performance-issues':
                return 'text-info';
            default:
                return 'text-muted';
        }
    }
}
