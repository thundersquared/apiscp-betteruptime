<?php declare(strict_types=1);

namespace sqrd\ApisCP\Extensions;

use Cache_Super_Global;
use DOMDocument;
use DOMXPath;
use HTTP_Request2;
use HTTP_Request2_Adapter_Curl;

class BetterUptime
{
    const STATUS_URL = MISC_SYS_STATUS;
    const STATUS_UNKNOWN = 'Unknown';
    const TIMEOUT = 5;

    public function getStatusPage(): string
    {
        return static::STATUS_URL;
    }

    protected function performRequest($url)
    {
        $adapter = new HTTP_Request2_Adapter_Curl();
        $request = new HTTP_Request2($url, HTTP_Request2::METHOD_GET, ['adapter' => $adapter]);
        $request->setConfig('connect_timeout', self::TIMEOUT);
        $request->setConfig('timeout', self::TIMEOUT);
        $response = $request->send();
        if ($response->getStatus() !== 200) return false;
        return $response->getBody();
    }

    public function getNetworkStatus()
    {
        if (!static::STATUS_URL)
        {
            return null;
        }

        $key = "sys.status";
        $cache = Cache_Super_Global::spawn();

        if (false !== ($status = $cache->get($key)))
        {
            return $status;
        }

        try
        {
            $body = $this->performRequest(static::STATUS_URL);
            if ($body === false) return static::STATUS_UNKNOWN;

            $dom = new DomDocument();
            @$dom->loadHTML($body);

            $xpath = new DOMXpath($dom);
            $status = $xpath->query("//h1[contains(@class, 'status-page__title')]")->item(0)->textContent;

            $cache->set($key, $status, 300);
        } catch (\Exception $e)
        {
            $status = static::STATUS_UNKNOWN;
        }

        return $status;
    }

    public function textByStatus($status)
    {
        return false !== strpos(strtolower($status), 'online') ? 'text-success' : 'text-danger';
    }
}
