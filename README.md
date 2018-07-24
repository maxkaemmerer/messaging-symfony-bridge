# maxkaemmerer/messaging-symfony-bridge

This is a bridge providing DI for maxkaemmerer/events and maxkaemmerer/command in symfony.

Just register the needed compiler passes in your symfony Kernel as seen below.

``CommandBus`` and ``EventCourier`` are automatically registered as services.

Every symfony service implementing ``CommandHandler`` or ``EventSubscriber`` get automatically registered in the ``EventCourier`` or ``CommandBus``.

So the only thing you need to do is start dispatching commands and events implementing the corresponding interfaces ``Command`` and ``Event``, as seen in the documentation of [maxkaemmerer/events](https://github.com/maxkaemmerer/events) and [maxkaemmerer/commands](https://github.com/maxkaemmerer/commands). ;)
 
 Symfony Kernel:
 
    use MaxKaemmerer\MessagingSymfonyBridge\CompilerPass\CommandBusPass;
    use MaxKaemmerer\MessagingSymfonyBridge\CompilerPass\EventCourierPass;
    use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
    use Symfony\Component\Config\Loader\LoaderInterface;
    use Symfony\Component\Config\Resource\FileResource;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Kernel as BaseKernel;
    use Symfony\Component\Routing\RouteCollectionBuilder;
    
    class Kernel extends BaseKernel
    {
    
        // ...
        
        protected function build(ContainerBuilder $container)
        {
            $container->addCompilerPass(new CommandBusPass());
            $container->addCompilerPass(new EventCourierPass());
            parent::build($container);
        }
        
        // ...
        
     }

More detailed examples might follow.