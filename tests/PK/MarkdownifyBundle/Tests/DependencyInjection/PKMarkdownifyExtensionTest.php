<?php

namespace PK\MarkdownifyBundle\Tests\DependencyInjection;

use Markdownify\ConverterExtra;
use PK\MarkdownifyBundle\DependencyInjection\PKMarkdownifyExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class PKMarkdownifyExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $container = $this->getContainer('config.yml');

        $this->assertTrue($container->hasDefinition('markdownify'));
        $def = $container->getDefinition('markdownify');
        $this->assertEquals(ConverterExtra::class, $def->getClass());
    }

    /**
     * Assert the arguments are passed through from the service definition yml file.
     */
    public function testArguments()
    {
        $container = $this->getContainer('args.yml');

        $def = $container->getDefinition('markdownify');

        $this->assertEquals(2, $def->getArgument(0)); // linkPosition
        $this->assertEquals(60, $def->getArgument(1)); // bodyWidth
        $this->assertEquals(false, $def->getArgument(2)); // keepHtml
    }

    /**
     * @param string $file
     *
     * @return ContainerBuilder
     */
    protected function getContainer($file)
    {
        $container = new ContainerBuilder(new ParameterBag(['kernel.debug' => true]));
        $container->registerExtension(new PKMarkdownifyExtension());

        $locator = new FileLocator(__DIR__ . '/Fixtures');
        $loader = new YamlFileLoader($container, $locator);

        $loader->load($file);
        $container->compile();

        return $container;
    }
}
