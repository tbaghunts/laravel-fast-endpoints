<?php

namespace Baghunts\LaravelFastEndpoint\Scanner;

use ReflectionClass;
use ReflectionAttribute;
use ReflectionException;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

use Baghunts\LaravelFastEndpoint\Contracts\ScannerContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointAttributeContract;

class Scanner implements ScannerContract
{
    private array $files;

    const string NAMESPACE_AND_CLASSNAME_FROM_FILE_CONTENT_REGEXP = "/namespace\s{1,}(.*);.*|\n*class\s{1,}([a-zA-Z0-1]*)/m";

    public function __construct(
        private readonly string $dir,
        private readonly string $signature
    )
    {
        $this->files = $this->findPHPFiles();
    }

    /**
     * @throws ReflectionException
     */
    public function findEndpoints(): Collection
    {
        $data = [];

        foreach ($this->findClasses() as $class) {
            $reflectionClass = new ReflectionClass($class);

            if ($reflectionClass->isSubclassOf($this->signature)) {
                $endpointConfig = $this->getEndpointConfiguration($reflectionClass);
                if (empty($endpointConfig->getMethod())) {
                    continue;
                }

                $data[$reflectionClass->getName()] = $this->getEndpointConfiguration($reflectionClass);
            }
        }

        return collect($data);
    }

    protected function findClasses(): array
    {
        $data = [];

        foreach ($this->files as $filePath) {
            $fileClassNamespace = $this->getClassNamespace($filePath);
            if (is_null($fileClassNamespace)) {
                continue;
            }

            $data[] = $fileClassNamespace;
        }

        return $data;
    }

    protected function findPHPFiles(): array
    {
        if (!File::exists($this->dir)) {
            return [];
        }

        $data = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->dir)
        );

        foreach ($iterator as $file) {
            if ($file->isDir()) {
                continue;
            }

            if (pathinfo($file->getFilename(), PATHINFO_EXTENSION) === 'php') {
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
        $endpointAttributes = $reflectionClass->getAttributes(
            EndpointAttributeContract::class,
            ReflectionAttribute::IS_INSTANCEOF
        );

        foreach ($endpointAttributes as $attribute) {
            /**
             * @var EndpointAttributeContract $configurableAttributeInstance
             */
            $configurableAttributeInstance = $attribute->newInstance();
            $configurableAttributeInstance->apply($endpointConfigContract);
        }

        return $endpointConfigContract;
    }

}