<?php

namespace Acme\FindMartialBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AcmeFindMartialExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
                $loader->load('services.yml');
                $loader->load('security_acl_dbal.yml');



        $container
            ->getDefinition('security.acl.dbal.schema_listener')
            ->addTag('doctrine.event_listener', array(
                'connection' => 'default',
                'event'      => 'postGenerateSchema',
                'lazy'       => true
            ))
        ;

        $container->getDefinition('security.acl.cache.doctrine')->addArgument('sf2_acl_');

        $container->setParameter('security.acl.dbal.class_table_name', 'acl_classes');
        $container->setParameter('security.acl.dbal.entry_table_name', 'acl_entries');
        $container->setParameter('security.acl.dbal.oid_table_name', 'acl_object_identities');
        $container->setParameter('security.acl.dbal.oid_ancestors_table_name', 'acl_object_identity_ancestors');
        $container->setParameter('security.acl.dbal.sid_table_name', 'acl_security_identities');
    }
}
