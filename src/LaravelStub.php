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
     * Stub destination path.
     *
     * @var string
     */
    protected string $to;

    /**
     * Get stub path.
     */
    public function from(string $path): static
    {
        $this->from = $path;

        return $this;
    }

    /**
     * Get stub destination path.
     */
    public function to(string $to): static
    {
        $this->to = $to;

        return $this;
    }
}
