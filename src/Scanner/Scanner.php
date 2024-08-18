<?php

namespace Baghunts\LaravelFastEndpoints\Scanner;

use ReflectionClass;
use ReflectionAttribute;

use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

use Illuminate\Support\Facades\File;

use Baghunts\LaravelFastEndpoints\Contracts\ScannerContract;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointAttributeContract;

class Scanner implements ScannerContract
{
    private array $files;

    private array $endpoints = [];

    private array $parentalEndpoints = [];

    const string NAMESPACE_AND_CLASSNAME_FROM_FILE_CONTENT_REGEXP = "/namespace\s{1,}(.*);.*|\n*class\s{1,}([a-zA-Z0-1]*)/m";

    public function __construct(
        private readonly string $dir,
        private readonly string $signature
    )
    {
        $this->files = $this->findPhpFiles();
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function findEndpoints(): array
    {
        foreach ($this->findClasses() as $class) {
            if (!class_exists($class)) {
                continue;
            }

            $reflectionClass = new ReflectionClass($class);

            if (!$reflectionClass->isSubclassOf($this->signature)) {
                continue;
            }

            $endpointConfig = $this->getEndpointConfiguration($reflectionClass);
            if (empty($endpointConfig->getMethod())) {
                continue;
            }

            $this->endpoints[$reflectionClass->getName()] = $endpointConfig;
        }

        return $this->freeParentalEndpoints();
    }
    protected function findClasses(): array
    {
        $data = [];

        foreach ($this->getFiles() as $filePath) {
            $fileClassNamespace = $this->getClassNamespace($filePath);
            if (is_null($fileClassNamespace)) {
                continue;
            }

            $data[] = $fileClassNamespace;
        }

        return $data;
    }

    protected function freeParentalEndpoints(): array
    {
        foreach ($this->parentalEndpoints as $parentClass) {
            if (!empty($this->endpoints[$parentClass])) {
                unset($this->endpoints[$parentClass]);
            }
        }

        return $this->endpoints;
    }

    protected function findPhpFiles(): array
    {
        if (!File::exists($this->dir)) {
            return [];
        }

        $data = [];

        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($this->dir)
        );

        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }

            $file_extension = pathinfo($file->getFilename(), PATHINFO_EXTENSION);
            if ($file_extension === 'php') {
                $data[] = $file->getPathname();
            }
        }

        return $data;
    }

    protected function getClassNamespace(string $filePath): ?string
    {
        $content = file_get_contents($filePath);
        preg_match_all(self::NAMESPACE_AND_CLASSNAME_FROM_FILE_CONTENT_REGEXP, $content, $matches);

        $namespaceGroup = $matches[1] ?? [];
        $classNameGroup = $matches[2] ?? [];

        $namespace = $namespaceGroup[0] ?? null;
        $className = $classNameGroup[1] ?? null;

        if (!$namespace || !$className) {
            return null;
        }

        return sprintf("%s\\%s", $namespace, $className);
    }

    protected function getEndpointConfiguration(ReflectionClass $reflectionClass): EndpointConfigContract
    {
        $endpointConfigContract = app(EndpointConfigContract::class);
        $endpointAttributes = $this->collectAttributesRecursively($reflectionClass);

        foreach ($endpointAttributes as $attribute) {
            /**
             * @var EndpointAttributeContract $configurableAttributeInstance
             */
            $configurableAttributeInstance = $attribute->newInstance();
            $configurableAttributeInstance->apply($endpointConfigContract);
        }

        return $endpointConfigContract;
    }

    private function collectAttributesRecursively(ReflectionClass $reflectionClass): array
    {
        $data = [];
        $isParentClassIteration = false;

        do {
            $data = array_merge($data, $reflectionClass->getAttributes(
                EndpointAttributeContract::class,
                ReflectionAttribute::IS_INSTANCEOF
            ));

            if (!$isParentClassIteration) {
                $isParentClassIteration = true;
                continue;
            }

            if (!empty($data)) {
                $this->parentalEndpoints[] = $reflectionClass->getName();
            }
        } while ($reflectionClass = $reflectionClass->getParentClass());

        return $data;
    }
}