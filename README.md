- composer create-project --prefer-dist laravel/laravel blog
- php artisan key:generate
- php -S localhost:8000 -t public/
- composer require nao-pon/flysystem-google-drive - installazione https://github.com/nao-pon/flysystem-google-drive
- installare client php di google composer require google/apiclient:"^2.7" 
- creazione progetto google developer e abilitazione api "drive"
- creare "service account" in credenziali progetto, e scaricare la chiave json salvandola in credentials.json
- il service account è come se fosse un utente google, per cui bisogna concedere i permessi a una cartella del proprio drive
  a questo utente (è la mail del service account elencato nelle credenziali del progetto)


# uso

## disco flysystem
- creare provider per driver google (factory per client google api)
- configurare disco

## api
- creare client api https://github.com/googleapis/google-api-php-client
- usare il client per interrogare direttamente le api



### referenze
- https://www.web2e.it/blog/google-drive-api-creare-un-app-php-per-gestire-il-tuo-drive
- https://gist.github.com/sergomet/f234cc7a8351352170eb547cccd65011
- https://github.com/googleapis/google-api-php-client
- https://github.com/ivanvermeyen/laravel-google-drive-demo
- https://developers.google.com/drive/api/v3/reference