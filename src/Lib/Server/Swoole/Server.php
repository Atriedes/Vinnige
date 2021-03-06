<?php

namespace Vinnige\Lib\Server\Swoole;

use Vinnige\Contracts\ContainerInterface;
use Vinnige\Contracts\ServerInterface;

/**
 * Class Server
 * @package Vinnige\Lib\Server\Swoole
 */
class Server implements ServerInterface
{
    /**
     * @var \swoole_http_server
     */
    public $server;
    /**
     * @var ContainerInterface
     */
    private $app;

    /**
     * @param ContainerInterface $app
     */
    public function __construct(ContainerInterface $app)
    {
        $this->app = $app;

        /**
         * create new swoole object
         */
        $this->server = new \swoole_http_server(
            $this->app['Config']['server.hostname'],
            $this->app['Config']['server.port'],
            SWOOLE_PROCESS
        );

        /**
         * set swoole configuration
         */
        $this->server->setGlobal(HTTP_GLOBAL_ALL);
        $this->server->set($this->app['Config']['server.config']);
    }

    /**
     * @param string $event
     * @param callable $callback
     */
    public function on($event, callable $callback)
    {
        /**
         * register request handler
         */
        $this->server->on(
            $event,
            $callback
        );
    }

    /**
     * @param int $interval
     * @param callable $callback
     */
    public function once($interval, callable $callback)
    {
        $this->server->after($interval, $callback);
    }

    /**
     * @param int $interval
     * @param callable $callback
     */
    public function periodic($interval, callable $callback)
    {
        $this->server->tick($interval, $callback);
    }

    /**
     * @param mixed $data
     */
    public function asyncTask($data)
    {
        $this->server->task($data);
    }

    /**
     * @param mixed $data
     * @return mixed
     */
    public function blockingTask($data)
    {
        return $this->server->taskwait($data);
    }

    /**
     * run server
     */
    public function run()
    {

        $this->app['Swoole'] = $this->server;

        echo "server started on http://{$this->app['Config']['server.hostname']}:{$this->app['Config']['server.port']}"
            . PHP_EOL;
        echo swoole_version() . PHP_EOL;

        /**
         * start swoole http server
         */
        $this->server->start();
    }
}
