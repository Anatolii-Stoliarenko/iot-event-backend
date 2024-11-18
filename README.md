# IoT Event Backend

---

## Opis projektu

To jest backend projektu obsługującego zdarzenia IoT. Aplikacja przetwarza różne typy zdarzeń, takie jak awarie urządzeń (`deviceMalfunction`), przekroczenie temperatury (`temperatureExceeded`) oraz odblokowanie drzwi (`doorUnlocked`). System jest oparty na Symfony i obsługuje walidację danych, rejestrowanie zdarzeń i zewnętrzną komunikację.

---

## Struktura projektu

```plaintext
iot-event-backend/
├── bin/
├── config/
├── public/
├── src/
│   ├── Controller/
│   │   └── ApiController.php
│   ├── Model/
│   ├── Services/
│   │   ├── Handlers/
│   │   │   ├── DeviceMalfunctionHandler.php
│   │   │   ├── DoorUnlockedHandler.php
│   │   │   └── TemperatureExceededHandler.php
│   │   ├── Communication/
│   │   │   ├── EmailService.php
│   │   │   ├── SmsService.php
│   │   │   └── RestRequestService.php
│   │   └── LoggerService.php
│   ├── Validators/
│   │   └── EventValidationService.php
│   └── Kernel.php
├── var/
├── vendor/
├── composer.json
└── README.md
```

---

## Wymagania

- **PHP** - 8.x lub wyższy
- **Composer** -
- **Symfony** - CLI (opcjonalnie)
- **Serwer** - HTTP, np. Apache lub Nginx

---

## Dodatkowe Narzędzia

Projekt może być wykorzystywany w połączeniu z frontendem dostępnym w repozytorium [iot-event-hub](https://github.com/Anatolii-Stoliarenko/iot-event-hub.git).

**Technologie frontendowe:**

- **Framework:** Angular
- **Komunikacja z backendem:** REST API

---

## Instalacja

1. Sklonuj repozytorium:

```bash
git clone https://github.com/Anatolii-Stoliarenko/iot-event-backend.git
cd iot-event-backend
```


2. Zainstaluj zależności:

```bash
composer install
```


3. Uruchom serwer deweloperski Symfony:

```bash
symfony serve
```


Aplikacja będzie dostępna pod adresem http://127.0.0.1:8000

---

## Narzędzia do Rozwoju

Poniżej znajdziesz narzędzia, które mogą być pomocne w pracy z tym projektem:

- **Postman** - do testowania żądań API.
- **Symfony CLI** - do zarządzania projektem Symfony.
- **Composer** - do zarządzania zależnościami PHP.
- **VS Code** - polecane IDE z dodatkami do PHP/Symfony.
- **Git** - do zarządzania wersjonowaniem kodu.
- **Docker (opcjonalnie)** - do szybkiego uruchomienia środowiska projektowego.

---

## Użycie

Aplikacja obsługuje żądania REST przez punkt końcowy `/api/event`. Wysyłane dane muszą być zgodne z wymaganym formatem dla każdego zdarzenia. Przykładowe zdarzenia:

---

## Przykładowy Request

**POST** `/api/event`

```json
{
  "eventType": "deviceMalfunction",
  "deviceId": "Qwmjrx1t",
  "eventDate": 1731962516,
  "reasonCode": 217,
  "reasonText": "Generated reason ..."
}
```

---

## Przykładowa Odpowiedź

```json
{
  "message": "Request received and processed!",
  "receivedData": {
    "eventType": "deviceMalfunction",
    "deviceId": "Qwmjrx1t",
    "eventDate": 1731962516,
    "reasonCode": 217,
    "reasonText": "Generated reason ..."
  },
  "details": {
    "status": "success",
    "message": "Zdarzenie deviceMalfunction: zalogowane i wysłano e-mail."
  }
}
```

---

## Sposób współpracy z frontem

Aby współpracować z frontendem znajdującym się w repozytorium iot-event-hub, należy:

1. Uruchomić backend zgodnie z instrukcją w sekcji Instalacja.
2. Sklonować i uruchomić projekt frontendowy:

```bash
git clone https://github.com/Anatolii-Stoliarenko/iot-event-hub.git
cd iot-event-hub
npm install
npm start
```


3. Upewnić się, że frontend jest skonfigurowany do komunikacji z backendem poprzez endpointy dostępne na http://127.0.0.1:8000.

---

## Dokumentacja

**Dostępne zdarzenia**

1. `deviceMalfunction` - Obsługuje awarie urządzeń.
2. `temperatureExceeded` - Obsługuje przekroczenie temperatury.
3. `doorUnlocked` - Obsługuje odblokowanie drzwi.

Każde zdarzenie przechodzi przez proces walidacji i obsługi, w zależności od jego typu.

---

## Licencja

Plik LICENSE zawiera informacje dotyczące licencji projektu.

---

## Kontakt

Jeśli masz jakiekolwiek pytania dotyczące projektu lub jego konfiguracji, skontaktuj się poprzez:

1. **Email**: [anatolii.stoliarenko@gmail.com](mailto:anatolii.stoliarenko@gmail.com)
2. **Strona**: [https://anatolii-stoliarenko.webflow.io/](https://anatolii-stoliarenko.webflow.io/)
