# maxkaemmerer/composer-package-template
[![Travis branch](https://img.shields.io/travis/maxkaemmerer/composer-package-template/master.svg?style=flat-square)](https://travis-ci.org/maxkaemmerer/composer-package-template)
[![Coveralls github](https://img.shields.io/coveralls/maxkaemmerer/composer-package-template/master.svg?style=flat-square&branch=master)](https://coveralls.io/github/maxkaemmerer/composer-package-template?branch=master)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/maxkaemmerer/composer-package-template.svg?style=flat-square)](https://packagist.org/packages/maxkaemmerer/composer-package-template)
[![Packagist](https://img.shields.io/packagist/v/maxkaemmerer/composer-package-template.svg?style=flat-square)](https://packagist.org/packages/maxkaemmerer/composer-package-template)
[![Packagist](https://img.shields.io/packagist/l/maxkaemmerer/composer-package-template.svg?style=flat-square)](https://packagist.org/packages/maxkaemmerer/composer-package-template)

This is a composer package template.
It's purpose is to quickly be able to start creating new composer packages, while taking care of some of the boilerplate setup.

 services.yml
 
    MaxKaemmerer\Commands\CommandBus:
        class: 'MaxKaemmerer\Commands\Implementations\SimpleCommandBus'

    MaxKaemmerer\Events\EventCourier:
        class: 'MaxKaemmerer\Events\Implementations\SimpleEventCourier'
 
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