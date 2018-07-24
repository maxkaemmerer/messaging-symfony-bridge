<?php

declare(strict_types=1);

namespace MaxKaemmerer\MessagingSymfonyBridge\CompilerPass;


use MaxKaemmerer\Commands\CommandBus;
use MaxKaemmerer\Commands\CommandHandler;
use MaxKaemmerer\Commands\Implementations\SimpleCommandBus;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class CommandBusPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $commandBus = new Definition(SimpleCommandBus::class);

        $container->addDefinitions([
            CommandBus::class => $commandBus
        ]);

        $definitions = $container->getDefinitions();

        foreach ($definitions as $definition) {
            if (\is_subclass_of($definition->getClass(), CommandHandler::class)) {
                $commandBus->addMethodCall('registerHandler', [CommandHandler::class => $definition]);
            }
        }
    }
}