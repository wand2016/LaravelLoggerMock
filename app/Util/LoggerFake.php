<?php

declare(strict_types=1);

namespace App\Util;

use Psr\Log\LoggerInterface;

/**
 * ログのテスト用 オンメモリfake
 */
class LoggerFake implements LoggerInterface
{
    /**
     * ログレベル別にメッセージを格納する
     * @var string[][] $repository
     */
    protected $repository = [];


    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = array())
    {
        $this->log('emergency', $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = array())
    {
        $this->log('alert', $message, $context);
    }


    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = array())
    {
        $this->log('critical', $message, $context);
    }


    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = array())
    {
        $this->log('error', $message, $context);
    }


    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = array())
    {
        $this->log('warning', $message, $context);
    }


    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = array())
    {
        $this->log('notice', $message, $context);
    }


    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = array())
    {
        $this->log('info', $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = array())
    {
        $this->log('debug', $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = array())
    {
        if (!isset($this->repository[$level])) {
            $this->repository[$level] = [];
        }

        $this->repository[$level][] = [$message, $context];
    }


    /**
     * 指定のログレベルでメッセージ、コンテキストを出力しているか
     * @param string $level ログレベル
     * @param string $message メッセージ
     * @param array $context=[] コンテキスト
     * @return bool 指定のログレベルでメッセージ、コンテキストを出力していればtrue
     */
    public function contains($level, $message, array $context = array()): bool
    {
        $ret = in_array([$message, $context], ($this->repository[$level] ?? []));

        if (!$ret) {
            var_dump([$message, $context]);
            var_dump($this->repository[$level] ?? []);
        }

        return $ret;
    }
}
