<?php

namespace iflow\Scrapy\implement\Query\Client;

use iflow\Scrapy\implement\Exception\ProxyException;

class Proxy {

    protected array $proxy = [];

    /**
     * @param string $host 代理地址
     * @param int $port 代理端口
     * @param string $scheme 代理服务器协议 https/http
     * @param string $username 用户名
     * @param string $password 密码
     * @param array $NonProxyDomain 不需要代理请求的域名地址
     * @return Proxy
     */
    public function addProxy(string $host, int $port, string $scheme = 'http', string $username = '', string $password = '', array $NonProxyDomain = []): Proxy {

        $proxyServerAccount = "";
        if ($username && $password) $proxyServerAccount = "$username:$password@";

        $proxyServer = sprintf("%s://%s%s:%d", $scheme, $proxyServerAccount, $host, $port);

        $this->proxy[] = [
            'proxy' => $proxyServer,
            'host' => $host,
            'port' => $port,
            'scheme' => $scheme,
            'username' => $username,
            'password' => $password,
            'NonProxyDomain' => $NonProxyDomain,
        ];
        return $this;
    }

    /**
     * 检测所选代理地址是否正常
     * @param array $proxy
     * @return void
     * @throws ProxyException
     */
    public function checkProxyServerStatus(array $proxy) {
        if (empty($proxy['proxy'])) throw new ProxyException("当前代理服务地址不存在", 404);
    }

    /**
     * 获取当前代理服务地址数量
     * @return int
     */
    public function getProxyServerLength(): int {
        return count($this->proxy);
    }

    public function get(int $offset) {
        return $this->proxy[$offset] ?? [];
    }

    public function has(int $offset): bool {
        return !empty($this->proxy[$offset]);
    }

    public function unset(int $offset) {
        unset($this->proxy[$offset]);
    }

    /**
     * 获取代理地址
     * @return array
     */
    public function getRandProxy(): array {
        $length = rand(0, $this -> getProxyServerLength());
        $proxy = $this->get($length);
        if (empty($proxy)) return [];
        return [ $proxy['scheme'] => $proxy['proxy'], 'non' => $proxy['NonProxyDomain'] ];
    }
}