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
     * Array of search and value. TODO: Fix
     *
     * @var array
     */
    protected array $replaces;

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
     * Set new replace with key and value.
     */
    public function replace(string $key, mixed $value): static
    {
        $this->replaces[$key] = $value;

        return $this;
    }

    /**
     * Set new replace with key and value.
     */
    public function replaces(array $replaces): static
    {
        foreach ($replaces as $key => $value) {
            $this->replaces[$key] = $value;
        }

        return $this;
    }

    /**
     * Generate stub file.
     */
    public function generate(): bool
    {
        // Check path is valid
        if (! File::exists($this->from)) {
            throw new \RuntimeException('The stub file is not exists, please enter a valid path.');
        }

        // Check destination path is valid
        if (! File::isDirectory($this->to)) {
            throw new \RuntimeException('The give folder path is not valid.');
        }

        // Get file content
        $content = File::get($this->from);

        // Replace variables
        foreach ($this->replaces as $search => $value) {
            $content = str_replace("{{ $search }}", $value, $content);
        }

        // Move file
        $path = "{$this->to}/{$this->name}";

        File::move($this->from, $path);

        // Put content and write on file
        File::put($path, $content);

        return true;
    }
}
