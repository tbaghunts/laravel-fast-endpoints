<?php

namespace Tests\Unit\Scanner;

use ReflectionClass;
use ReflectionException;

use Orchestra\Testbench\TestCase;

use PHPUnit\Framework\MockObject\MockBuilder;

use Baghunts\LaravelFastEndpoint\Scanner\Scanner;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoint\Endpoint\{Endpoint, EndpointConfig};

use Tests\Unit\Scanner\Dist\WithAttributes\{WithName, WithNameAndPost};

class ScannerTest extends TestCase
{
    private ?MockBuilder $scannerMockBuilder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->scannerMockBuilder = $this->getMockBuilder(Scanner::class);


        $this->afterApplicationCreated(function () {
            $this->app->bind(EndpointConfigContract::class, EndpointConfig::class);
        });
    }

    public function getInstance(?string $dir = null): Scanner
    {
        if (!$dir) {
            $dir = __DIR__ . '/./Dist';
        }

        return new Scanner(
            $dir,
            Endpoint::class
        );
    }

    public function test_shouldBeReturnEmptyArrayIfProvidedDirIsNotExists()
    {
        $this->execFindPhpFilesTest('/fake/dir', []);
    }

    public function test_shouldBeReturnAllPhpFilesInFolderAndSubfolders()
    {
        $this->execFindPhpFilesTest( __DIR__ . '/./Dist', [
            __DIR__ . '/./Dist/Folder/NestedEndpoint.php',
            __DIR__ . '/./Dist/Folder/NestedFolder/DoubleNestedEndpoint.php',
            __DIR__ . '/./Dist/Folder/NestedEndpointWithoutNamespace.php',
            __DIR__ . '/./Dist/TestEndpointFile.php',
            __DIR__ . '/./Dist/TestEndpointFileWithoutClassName.php',
            __DIR__ . '/./Dist/TestEndpointFileWithoutNamespace.php',
            __DIR__ . '/./Dist/WithAttributes/WithNameAndPost.php',
            __DIR__ . '/./Dist/WithAttributes/WithName.php',
            __DIR__ . '/./Dist/TestInvalidClass.php',
        ]);
    }

    public function test_classNameShouldBeActualFileNamespaceAndClassNameConcatenation()
    {
        $this->assertEquals(
            "Tests\Unit\Scanner\Dist\TestEndpointFile",
            $this->execClassNameDetectionTest(
                __DIR__ . '/./Dist/TestEndpointFile.php'
            )
        );
    }

    public function test_classNameShouldBeNullIfClassNameHasNotNamespace()
    {
        $this->assertNull(
            $this->execClassNameDetectionTest(
                __DIR__ . '/./Dist/TestEndpointFileWithoutNamespace.php'
            )
        );
    }

    public function test_classNameShouldBeNullIfClassNameHasNotClassName()
    {
        $this->assertNull(
            $this->execClassNameDetectionTest(
                __DIR__ . '/./Dist/TestEndpointFileWithoutClassName.php'
            )
        );
    }

    public function test_shouldReturnValidClassesNames()
    {
        $instance = $this->getInstance(__DIR__ . '/./Dist');

        $reflection = new ReflectionClass($instance);
        $method = $reflection->getMethod('findClasses');

        $classes = $method->invoke($instance);

        $this->assertEquals([
            'Tests\Unit\Scanner\Dist\Folder\NestedEndpoint',
            'Tests\Unit\Scanner\Dist\Folder\NestedFolder\DoubleNestedEndpoint',
            'Tests\Unit\Scanner\Dist\TestEndpointFile',
            'Tests\Unit\Scanner\Dist\WithAttributes\WithNameAndPost',
            'Tests\Unit\Scanner\Dist\WithAttributes\WithName',
        ], $classes);
    }

    public function test_endpointConfigShouldBeAppliedBySpecifiedSingleAttributes()
    {
        $reflector = new ReflectionClass(WithName::class);

        $instance = $this->getInstance();
        $instanceReflector = new ReflectionClass($instance);

        $method = $instanceReflector->getMethod("getEndpointConfiguration");

        $config = $method->invoke($instance, $reflector);

        $this->assertEquals("with.name", $config->getName());
        $this->assertEquals([], $config->getMethod());
    }

    public function test_endpointConfigShouldBeAppliedBySpecifiedMultipleAttributes()
    {
        $reflector = new ReflectionClass(WithNameAndPost::class);

        $instance = $this->getInstance();
        $instanceReflector = new ReflectionClass($instance);

        $method = $instanceReflector->getMethod("getEndpointConfiguration");

        $config = $method->invoke($instance, $reflector);

        $this->assertEquals("with.name", $config->getName());
        $this->assertEquals([EnumEndpointMethod::POST], $config->getMethod());
    }

    /**
     * @throws ReflectionException
     */
    public function test_shouldCollectValidClassesWhichHaveCorrectSignatureWithConfigs()
    {
        $this->assertEquals([], $this->getInstance()->findEndpoints());
        $this->assertEquals([
            'Tests\Unit\Scanner\Endpoints\Subfolder\SubEndpointWithWhereInAndPatch',
            'Tests\Unit\Scanner\Endpoints\EndpointWithNameAndPost',
        ], array_keys($this->getInstance(__DIR__ . '/./Endpoints')->findEndpoints()));
    }
    
    protected function execClassNameDetectionTest(string $path): ?string
    {
        $instance  = $this->scannerMockBuilder
            ->disableOriginalConstructor()
            ->getMock();

        $reflector = new ReflectionClass($instance);
        $method = $reflector->getMethod('getClassNamespace');

        return $method->invoke($instance, $path);
    }

    protected function execFindPhpFilesTest(string $dir, array $values): void
    {
        $instance = $this->getInstance($dir);

        $reflector = new ReflectionClass($instance);
        $method = $reflector->getMethod("findPhpFiles");

        $this->assertEquals($values, $method->invoke($instance));
    }
}