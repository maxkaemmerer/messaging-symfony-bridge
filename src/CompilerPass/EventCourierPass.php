<?php

declare(strict_types=1);

namespace MaxKaemmerer\MessagingSymfonyBridge\CompilerPass;


use MaxKaemmerer\Events\EventCourier;
use MaxKaemmerer\Events\EventSubscriber;
use MaxKaemmerer\Events\Implementations\SimpleEventCourier;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class EventCourierPass implements CompilerPassInterface
{


    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $eventCourier = new Definition(SimpleEventCourier::class);

        $container->addDefinitions([
            EventCourier::class => $eventCourier
        ]);

        $definitions = $container->getDefinitions();

        foreach ($definitions as $definition) {
            if (\is_subclass_of($definition->getClass(), EventSubscriber::class)) {
                $eventCourier->addMethodCall('subscribe', [EventSubscriber::class => $definition]);
            }
        }
    }
}