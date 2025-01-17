<?php

namespace Binafy\LaravelStub;

use Closure;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use RuntimeException;

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
     * The stub extension.
     *
     * @var string|null
     */
    protected string|null $ext;

    /**
     * The list of replaces.
     *
     * @var array
     */
    protected array $replaces = [];

    /**
     * The stub file move or not.
     *
     * @var bool
     */
    protected bool $moveStub = false;

    /**
     * The list of conditions.
     *
     * @var array
     */
    protected array $conditions = [];

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
     * Set stub extension.
     */
    public function ext(string $ext): static
    {
        $this->ext = $ext;

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
     * Set stub file move without any copy.
     */
    public function moveStub(): static
    {
        $this->moveStub = true;

        return $this;
    }

    /**
     * Set conditions.
     *
     * @param array<string, bool|mixed|Closure> $conditions
     */
    public function conditions(array $conditions): static
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Download the stub file.
     */
    public function download()
    {
        $this->generate();

        return Response::download($this->getPath());
    }

    /**
     * Set stub file move without any copy.
     */
    public function generateForce(): bool
    {
        return $this->generate(true);
    }

    /**
     * Generate stub if condition pass.
     */
    public function generateIf(bool $condition): bool
    {
        if ($condition) {
            return $this->generate();
        }

        return false;
    }

    /**
     * Generate stub if condition pass (reversed).
     */
    public function generateUnless(bool $condition): bool
    {
        if (! $condition) {
            return $this->generate();
        }

        return false;
    }

    /**
     * Generate stub file.
     */
    public function generate(bool $force = false): bool
    {
        // Check path is valid
        if (! File::exists($this->from)) {
            throw new RuntimeException("The {$this->from} stub file does not exist, please enter a valid path.");
        }

        // Check destination path is valid
        if (! File::isDirectory($this->to)) {
            throw new RuntimeException('The given folder path is not valid.');
        }

        // Check if files exists and it not force throw exception
        if (! File::exists($this->to) && !$force) {
            throw new RuntimeException('The destination file does not exist, please enter a valid path.');
        }

        // Get file content
        $content = File::get($this->from);

        // Replace variables
        foreach ($this->replaces as $search => $value) {
            $content = str_replace("{{ $search }}", $value, $content);
        }

        // Process conditions
        if (count($this->conditions) !== 0) {
            foreach ($this->conditions as $condition => $value) {
                if ($value instanceof Closure) {
                    $value = $value();
                }

                if ($value) {
                    // Replace placeholders for conditions that are true
                    $content = preg_replace(
                        "/^[ \t]*{{ if $condition }}\s*\n(.*?)(?=^[ \t]*{{ endif }}\s*\n)/ms",
                        "$1",
                        $content
                    );
                } else {
                    // Remove the entire block for conditions that are false
                    $content = preg_replace(
                        "/^[ \t]*{{ if $condition }}\s*\n.*?^[ \t]*{{ endif }}\s*\n/ms",
                        '',
                        $content
                    );
                }
            }

            // Finally, clean up any remaining conditional tags and extra newlines
            $content = preg_replace("/^[ \t]*{{ if .*? }}\s*\n|^[ \t]*{{ endif }}\s*\n/m", "\n", $content);
            $content = preg_replace("/^[ \t]*\n/m", "\n", $content);
        }

        // Get correct path
        $path = $this->getPath();

        if ($this->moveStub) {
            File::move($this->from, $path); // Move the file
        } else {
            File::copy($this->from, $path); // Copy the file
        }

        // Put content and write on file
        File::put($path, $content);

        return true;
    }

    /**
     * Get final path.
     */
    private function getPath(): string
    {
        $path = "{$this->to}/{$this->name}";

        // Add extension
        if (! is_null($this->ext)) {
            $path .= ".$this->ext";
        }

        return $path;
    }
}
