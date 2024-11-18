# IoT Event Backend

## Opis projektu

To jest backend projektu obsługującego zdarzenia IoT. Aplikacja przetwarza różne typy zdarzeń, takie jak awarie urządzeń (`deviceMalfunction`), przekroczenie temperatury (`temperatureExceeded`) oraz odblokowanie drzwi (`doorUnlocked`). System jest oparty na Symfony i obsługuje walidację danych, rejestrowanie zdarzeń i zewnętrzną komunikację.

---

## Struktura projektu

```plaintext
backend/
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

## Wymagania

- **PHP** - 8.x lub wyższy
- **Composer** -
- **Symfony** - CLI (opcjonalnie)
- **Serwer** - HTTP, np. Apache lub Nginx

---

## Instalacja

1. Sklonuj repozytorium:

```bash
git clone https://github.com/Anatolii-Stoliarenko/iot-event-backend.git
cd backend
```

2. Zainstaluj zależności:

```bash
composer install
```

3. Uruchom serwer deweloperski Symfony:

```bash
symfony serve
```

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

## Dokumentacja

**Dostępne zdarzenia**

1. deviceMalfunction - Obsługuje awarie urządzeń.
2. temperatureExceeded - Obsługuje przekroczenie temperatury.
3. doorUnlocked - Obsługuje odblokowanie drzwi.

Każde zdarzenie przechodzi przez proces walidacji i obsługi, w zależności od jego typu.

---

## Testy

Aby uruchomić testy, wykonaj polecenie:

```bash
php bin/phpunit
```

---

## Kontakty

1. **Email**: [anatolii.stoliarenko@gmail.com](mailto:anatolii.stoliarenko@gmail.com)
2. **Strona**: [https://anatolii-stoliarenko.webflow.io/](https://anatolii-stoliarenko.webflow.io/)
