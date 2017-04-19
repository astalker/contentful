<?php

namespace Markup\Contentful\Promise;

use GuzzleHttp\Promise\PromiseInterface;

abstract class ResourcePromise implements PromiseInterface
{
    use DelegatingPromiseTrait;
    use DelegatingMetadataPropertyAccessTrait;
    use ResolvedResourceTrait;

    public function __construct(PromiseInterface $promise)
    {
        $this->setPromise($promise);
    }
}
