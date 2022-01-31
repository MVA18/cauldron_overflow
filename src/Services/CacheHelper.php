<?php

namespace App\Services;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class CacheHelper
{
    private $cache;
    private $isDebug;
    private $cacheLogger;

    public function __construct(CacheInterface $cache, bool $isDebug, LoggerInterface $cacheLogger)
    {
        $this->cache    = $cache;
        $this->isDebug  = $isDebug;
        $this->cacheLogger   = $cacheLogger;
    }

    public function cache(string $source)
    {
        if(stripos($source, 'cat') !== false)
        {
            $this->cacheLogger->info('meow');
        }

        return (!$this->isDebug) ? $source :
            $this->cache->get('markdown_'.md5($source), function() use ($source) {
                return $source;
            });
    }
}