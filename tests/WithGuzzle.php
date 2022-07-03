<?php

namespace Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Arr;

trait WithGuzzle
{
    protected array $historyContainer;

    /**
     * @before
     */
    public function setUpGuzzle()
    {
        $this->historyContainer = [];
    }

    protected function makeResponse($data, $code = 200): Response
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        return new Response($code, ['Content-Type' => 'application/json'], $data);
    }

    protected function makeGuzzleClient(array $responses, array &$historyContainer = null): Client
    {
        $mock = new MockHandler($responses);
        $handlerStack = HandlerStack::create($mock);
        if (is_array($historyContainer)) {
            $history = Middleware::history($historyContainer);
        } else {
            $history = Middleware::history($this->historyContainer);
        }
        $handlerStack->push($history);
        return new Client(['handler' => $handlerStack]);
    }

    protected function assertGuzzleCallCount(int $count): void
    {
        $this->assertCount($count, $this->historyContainer);
    }

    protected function getGuzzleRequest(int $index): ?Request
    {
        $transaction = Arr::get($this->historyContainer, $index);
        if ($transaction) {
            return $transaction['request'];
        }
        return null;
    }
}
