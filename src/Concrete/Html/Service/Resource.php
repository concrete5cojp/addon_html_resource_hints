<?php

/**
 * Class Resource.
 *
 * @author: Biplob Hossain <biplob@concrete5.co.jp>
 *
 * @license MIT
 * Date: 2019/08/30
 */
namespace HtmlResourceHints\Html\Service;

use Concrete\Core\Application\Application;
use Concrete\Core\Error\UserMessageException;
use Concrete\Core\View\View;

/**
 * Class Resource.
 *
 * @method resource dnsPrefetch(string|array $host)
 * @method resource preconnect(string|array $host)
 * @method resource preload(string|array $host, $options)
 * @method resource prefetch(string|array $host, $options)
 * @method resource prerender(string|array $host)
 */
class Resource
{
    public function __call($method, $args)
    {
        $allowedMethods = ['dnsPrefetch', 'preconnect', 'preload', 'prefetch', 'prerender'];
        if (!in_array($method, $allowedMethods, true) || count($args) < 1) {
            throw new UserMessageException(t('Invalid method call.'));
        }
        $hint = $this->camelToDashed($method);

        if (is_array($args[0])) {
            foreach ($args[0] as $host) {
                $this->insertTag($hint, $host, $args[1] ?? null);
            }
        } else {
            $this->insertTag($hint, $args[0], $args[1] ?? null);
        }
    }

    public function insertTag($hint, $host, $options = []): void
    {
        $view = View::getInstance();
        if ($view) {
            $view->addHeaderAsset($this->getTag($hint, $host, $options));
        }
    }

    public function getTag($hint, $host, $options = null): string
    {
        return "<link rel=\"$hint\" href=\"$host\"" . $this->parseOptions($options). '>';
    }

    private function parseOptions($options): string {
        $string = '';
        if (is_array($options)) {
            foreach ($options as $key => $value) {
                if (is_bool($value)) {
                    $string .= " $key";
                } else {
                    $string .= " $key=\"$value\"";
                }
            }
        }

        return $string;
    }

    private function camelToDashed($string): string
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $string));
    }
}
