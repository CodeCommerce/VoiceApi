# Installation

    composer require codecommerce/alexaapi 
    
## Creating directories and config files

Mac / Linux:

```
    mkdir -p Alexa/Config && cp vendor/codecommerce/alexaapi/Config/* Alexa/Config && mkdir Alexa/Intents
```

Windows:
```
    mkdir Alexa
    cd Alexa
    mkdir Config
    mkdir Intents
    xcopy ../vendor/codecommerce/alexaapi/Config ./Config /e /i /h
```
    
