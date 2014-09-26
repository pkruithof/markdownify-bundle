<?php

use PK\MarkdownifyBundle\DependencyInjection\PKMarkdownifyExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;

class PKMarkdownifyExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testParameters()
    {
        $container = $this->getContainer();

        $this->assertTrue($container->hasParameter('pk.markdownify.class'));
        $this->assertTrue($container->hasDefinition('pk.markdownify'));

        $def = $container->getDefinition('pk.markdownify');
        $this->assertEquals($container->getParameter('pk.markdownify.class'), $def->getClass());

        $this->assertTrue($container->hasAlias('markdownify'));
        $this->assertEquals('pk.markdownify', $container->getAlias('markdownify'));
    }

    /**
     * @return ContainerBuilder
     */
    protected function getContainer()
    {
        $container = new ContainerBuilder(new ParameterBag(array('kernel.debug' => true)));
        $container->registerExtension(new PKMarkdownifyExtension());

        $locator = new FileLocator(__DIR__ . '/Fixtures');
        $loader  = new YamlFileLoader($container, $locator);
        $loader->load('config.yml');
        $container->compile();

        return $container;
    }
}
