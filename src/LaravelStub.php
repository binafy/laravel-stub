<?php

namespace Binafy\LaravelStub;

use Illuminate\Support\Facades\File;

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

    /**
     * Generate stub file.
     */
    public function generate(): bool
    {
        // Check path is valid

        // Check destination path is valid

        // Replace variables

        // Move file
        File::move($this->from, $this->to);

        // Put content and write on file
        File::put($this->to, 'milwad');

        return true;
    }
}
