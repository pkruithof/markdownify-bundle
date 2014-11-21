<?php

namespace PK\MarkdownifyBundle\DependencyInjection;

use Markdownify\ConverterExtra;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritdoc
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pk_markdownify');
        $rootNode
            ->children()
                ->scalarNode('link_position')
                    ->defaultValue(ConverterExtra::LINK_AFTER_CONTENT)
                    ->info(<<<EOT
Where to put the link references:
  * 0 for after the content (default)
  * 1 for after each paragraph
  * 2 for in the paragraph, directly after the link text
EOT
                    )
                ->end()
                ->scalarNode('body_width')
                    ->defaultFalse()
                    ->info(<<<EOT
When larger than the minimal width (25), the body will be
wrapped to this width. Set to false to disable wrapping
(default)
EOT
                    )
                ->end()
                ->booleanNode('keep_html')
                    ->defaultFalse()
                    ->info('Whether to keep html tags which cannot be converted to markdown')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
