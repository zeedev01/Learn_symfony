<?php
/**
 * Created by PhpStorm.
 * User: Zeeshan.Saif
 * Date: 7/20/2018
 * Time: 11:28 AM
 */

namespace App\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Matcher\UrlMatcher;
//use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class LocaleSubscriber
 * @package App\EventSubscriber
 */
class LocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var string
     */
    private $defaultLocale;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var array
     */
    private $supportedLocales;

    /**
     * @var string
     */
    private $localeRouteParam;

    /**
     * @var \Symfony\Component\Routing\RouteCollection
     */
    private $routeCollection;

    /**
     * @var urlMatcher \Symfony\Component\Routing\Matcher\UrlMatcher;
     */
    //private $urlMatcher;

    /**
     * LocaleSubscriber constructor.
     * @param RouterInterface $router
     * @param string $defaultLocale
     * @param array $supportedLocales
     * @param string $localeRouteParam
     */
    public function __construct(RouterInterface $router, $defaultLocale = 'de', array $supportedLocales = array('en') , $localeRouteParam = '_locale')
    {
        $this->router = $router;
        $this->routeCollection = $router->getRouteCollection();
        $this->defaultLocale = $defaultLocale;
        $this->supportedLocales = $supportedLocales;
        $this->localeRouteParam = $localeRouteParam;
        //$context = new RequestContext("/");
        //$this->urlMatcher = new UrlMatcher($this->routeCollection, $context);
    }


    public function isLocaleSupported($locale)
    {
        return array_key_exists($locale,$this->supportedLocales);
    }


    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        //GOAL:
        // Redirect all incoming requests to their /locale/route equivlent as long as the route will exists when we do so.
        // Do nothing if it already has /locale/ in the route to prevent redirect loops
        $request = $event->getRequest();
        $path = $request->getPathInfo();

        $route_exists = false; //by default assume route does not exist.

        foreach($this->routeCollection as $routeObject){
            $routePath = $routeObject->getPath();
            //echo $routeObject->getPath();
            if($routePath == "/{_locale}".$path){
                $route_exists = true;
                break;
            }
        }
        //If the route does indeed exist then lets redirect there.
        if($route_exists == true){
            //Get the locale from the users browser.
            $locale = $request->getPreferredLanguage();

            // $request->setLocale($locale);
            //If no locale from browser or locale not in list of known locales supported then set to defaultLocale set in config.yml
            if($locale==""  || $this->isLocaleSupported($locale)==false){
                $locale = $request->getDefaultLocale();
            }

            $event->setResponse(new RedirectResponse("/".$locale.$path));
        }

    /* $request = $event->getRequest();

     if (!$request->hasPreviousSession()) {
         return;
     }

     if ($locale = $request->attributes->get('_locale')) {
         $request->getSession()
             ->set('_locale', $locale);
     } else {
         $request->setLocale(
             $request->getSession()
                 ->get('_locale', $this->defaultLocale)
         );
     }*/

    }
    public static function getSubscribedEvents()
    {
        return [
            // must be registered before the default Locale listener
            KernelEvents::REQUEST => [
                [
                    'onKernelRequest',
                    20,
                ],
            ],
        ];
    }
}