<?php

namespace Baghunts\LaravelFastEndpoint\Generator;

use Str;

use Illuminate\Support\Facades\File;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGeneratorContract;

abstract class ClassGenerator implements ClassGeneratorContract
{
    private array $imports = [];
    private ?string $source = null;

    protected abstract function getStubName(): string;

    public function __construct(
        protected readonly string $dist,
        protected readonly string $base,
    )
    {
        if (!empty($this->base)) {
            $this->setImport($this->base);
        }

        if (method_exists($this, 'traitConfig')) {
            $this->traitConfig();
        }
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getImports(): array
    {
        return $this->imports;
    }

    public function getDist(): string
    {
        return sprintf("%s.php", $this->dist);
    }

    public function getClassName(): string
    {
        return Str::of($this->dist)
            ->afterLast(DIRECTORY_SEPARATOR);
    }

    public function getNamespace(): string
    {
        return Str::of($this->dist)
            ->beforeLast(DIRECTORY_SEPARATOR)
            ->replace(DIRECTORY_SEPARATOR, '\\')
            ->ucfirst();
    }

    public function getFileNamespace(): string
    {
        return sprintf(
            "%s\\%s",
            $this->getNamespace(),
            $this->getClassName()
        );
    }

    public function getBaseClassName(): ?string
    {
        if (empty($this->base)) {
            return null;
        }

        return Str::of($this->base)->afterLast('\\');
    }

    final public function generate(): self
    {
        $data = $this->getReplaceableData();
        $keys = $this->createReplaceableKeysFrom(
            array_keys($data)
        );

        $this->source = preg_replace(
            $keys,
            array_values($data),
            $this->getStub()
        );

        return $this;
    }

    private function createReplaceableKeysFrom(array $data): array
    {
        return array_map(function ($key) {
            return "#{{\s{0,}$key\s{0,}}}#";
        }, $data);
    }

    private function getStub(): string
    {
        return File::get(
            $this->getStubPath(
                $this->getStubName()
            )
        );
    }

    public function getStubPath(string $name): string
    {
        $path = base_path("/./stubs/fast-endpoints/$name.stub");
        if (!File::exists($path)) {
            $path = __DIR__ . "/../stubs/$name.stub";
        }

        return $path;
    }

    public function setImport(string $namespace, array|string|null $entity = null): self
    {
        $new = collect($entity);
        $exists = collect($this->imports[$namespace] ?? []);

        if ($new->isNotEmpty()) {
            $processable = $new->diff($exists);

            if (!$processable->isEmpty()) {
                $exists = $exists->merge($processable);
            }
        }

        $this->imports[$namespace] = $exists->toArray();

        return $this;
    }

    private function getReplaceableData(): array
    {
        return array_merge($this->getReplaceable(), [
            'CLASS' => $this->getClassName(),
            'BASE' => $this->getBaseClassName(),
            'NAMESPACE' => $this->getNamespace(),
            'IMPORTS' => $this->getImportsSource(),
        ]);
    }

    protected function getReplaceable(): array
    {
        return [];
    }

    private function getImportsSource(): string
    {
        return collect($this->imports)->map(function (array $entities, string $namespace) {
            return sprintf(
                'use %s%s;',
                $namespace,
                $this->generateImportNamespaceEntities($entities)
            );
        })->join(PHP_EOL);
    }

    private function generateImportNamespaceEntities(array $entities): string
    {
        if (empty($entities)) {
            return '';
        }

        return sprintf('\\{%s}', implode(',' . PHP_EOL, $entities));
    }
}