<?php

namespace Markup\Contentful\Promise;

use Markup\Contentful\ResourceArrayInterface;
use Markup\Contentful\ResourceEnvelope;
use Markup\Contentful\ResourceInterface;

class ResourceArrayPromise extends ResourcePromise implements ResourceArrayInterface
{
    /**
     * @return \Traversable
     */
    public function getIterator()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface) {
            return new \ArrayIterator();
        }
        if (is_array($resolved)) {
            return new \ArrayIterator($resolved);
        }

        return $resolved->getIterator();
    }

    /**
     * Gets the total number of results in this array (i.e. not limited or offset).
     *
     * @return int
     */
    public function getTotal()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface) {
            return 0;
        }
        if (is_array($resolved)) {
            return count($resolved);
        }

        return $resolved->getTotal();
    }

    /**
     * @return int
     */
    public function getSkip()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface || is_array($resolved)) {
            return 0;
        }

        return $resolved->getSkip();
    }

    /**
     * @return int
     */
    public function getLimit()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface || is_array($resolved)) {
            return 0;
        }

        return $resolved->getLimit();
    }

    /**
     * @return ResourceEnvelope
     */
    public function getEnvelope()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface) {
            return new ResourceEnvelope();
        }

        return $resolved->getEnvelope();
    }

    /**
     * Gets the count of items in this array. This does not represent the total count of a result set, but the possibly offset/limited count of items in this array.
     *
     * @return int
     */
    public function count()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface && !is_array($resolved)) {
            return 0;
        }

        return count($resolved);
    }

    /**
     * Gets the first item in this array, or null if array is empty.
     *
     * @return ResourceInterface|null
     */
    public function first()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface && !is_array($resolved)) {
            return null;
        }
        if (is_array($resolved)) {
            return (count($resolved) > 0) ? array_values($resolved)[0] : null;
        }

        return $resolved->first();
    }

    /**
     * Gets the last item in this array, or null if array is empty.
     *
     * @return ResourceInterface|null
     */
    public function last()
    {
        $resolved = $this->getResolved();
        if (!$resolved instanceof ResourceArrayInterface && !is_array($resolved)) {
            return null;
        }
        if (is_array($resolved)) {
            return (count($resolved) > 0) ? array_values(array_slice($resolved, -1))[0] : null;
        }

        return $resolved->last();
    }
}
