<?php

namespace Binafy\LaravelStub;

class LaravelStub
{
    /**
     * Stub path.
     *
     * @var string
     */
    protected string $from;

    /**
     * Get stub path.
     */
    public function from(string $path): static
    {
        $this->from = $path;

        return $this;
    }
}
