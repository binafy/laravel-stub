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
     * The new name of stub file.
     *
     * @var string
     */
    protected string $name;

    /**
     * Set stub path.
     */
    public function from(string $path): static
    {
        $this->from = $path;

        return $this;
    }

    /**
     * Set stub destination path.
     */
    public function to(string $to): static
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set new stub name.
     */
    public function name(string $name): static
    {
        $this->name = $name;

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
        $path = "{$this->to}/{$this->name}";

        File::move($this->from, $path);

        // Put content and write on file
        File::put($path, '');

        return true;
    }
}
