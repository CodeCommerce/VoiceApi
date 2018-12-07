# Installation

    composer require codecommerce/alexaapi 
    
## Creating directories and config files
### Mac OS
    
    mkdir -p Alexa/Config && cp vendor/codecommerce/alexaapi/Config/* Alexa/Config && mkdir Alexa/Intents

### Windows

    mkdir Alexa
    cd Alexa
    mkdir Config
    mkdir Intents
    xcopy ../vendor/codecommerce/alexaapi/Config ./Config /e /i /h

## Projekt composer.json

Erstelle eine composer.json in deinem Projektordner.
Fordere via require die AlexaApi an.
Schreibe deinen Namespace in in autoload -> psr-4

    {
        "require": {
            "codecommerce/alexaapi": "^1.0"
        },
        "autoload": {
            "psr-4": {
                "AlexaSpielwiese\\Alexa\\": "./Alexa"
            }
        }
    }

## Erster Intent
    
Erstelle eine Klasse und gebe den Namespace (siehe Projekt composer.json) an.
Implementire das Interface 'IntentsInterface'.
Übernehme die Methoden die das Interface vorraussetzt.
Du kanns im Konstruktor die Variablen $sytem und $request auf eine Klassenvariable legen und somit überall verwenden.

    <?php
    
    namespace AlexaSpielwiese\Alexa\Intents;
    
    use CodeCommerce\AlexaApi\Intents\IntentsInterface;
    use CodeCommerce\AlexaApi\Model\Request;
    use CodeCommerce\AlexaApi\Model\System;
    
    class TestIntent implements IntentsInterface
    {
        protected $request;
        protected $system;
    
        /**
         * IntentsInterface constructor.
         * @param Request $request
         * @param System  $system
         */
        public function __construct(Request $request, System $system)
        {
            $this->request = $request;
            $this->system = $system;
        }
    
        /**
         * @return mixed
         */
        public function runIntent()
        {
            // TODO: Implement runIntent() method.
        }
    }

In der Methode runIntent passiert die ganze Magic.

## Routing

Füge deine neue Klasse in das Routing ein.
    
    Alexa/Config/routes.yml

Der Intent muss den gleichen Namen haben wie in der Developer Konsole bei Amazon

routes.yml

    TestIntent: AlexaSpielwiese\Alexa\Intents\TestIntent
    
Die API macht nun den Rest und geht auf deinen hinterlegten Intent.

## Prüfen auf Display

Du kannst dir das Display-Ausgabegerät vom $system zurückgeben lassen und somit
prüfen ob es eine Displayunterstützung gibt.

    $this->system->getDisplay()

## Endpoint Konfigurieren

Die Datei die den Endpoint darstellt muss folgenden Aufruf erhalten

    require __DIR__ . '/../vendor/autoload.php';
    new CodeCommerce\AlexaApi\Controller\RequestHandler();
    
    
## Hintergrundbild hinzufügen

    $backgroundImage = new BackgroundImage();
    $backgroundImage->setSources('DEINE_URL');

    $response = new Response($outspeech);

    if ($this->system->getDisplay()) {
        $template = new Template();
        $template->setBackgroundImage($backgroundImage)
            ->setPrimary('Text 1')
            ->setSecondary('Text 2')
            ->setTertiary('Text 3')
            ->setType($template::BODY_TEMPLATE_2_IMAGE_LIMITED_CENTERED_TEXT);

        $directive = new Directives();
        $directive->setTemplate($template);
        $response->setDirectives($directive);
    }
