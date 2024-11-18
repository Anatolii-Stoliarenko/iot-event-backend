# IoT Event Backend

**Polska wersja**: Zobacz [README.pl.md](README.pl.md)

## Project Description

This is the backend of a project handling IoT events. The application processes various types of events such as device malfunctions (`deviceMalfunction`), temperature exceedance (`temperatureExceeded`), and door unlocking (`doorUnlocked`). The system is based on Symfony and handles data validation, event logging, and external communication.

---

## Project Structure

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

## Requirements

- **PHP** - 8.x or higher
- **Composer**
- **Symfony** - CLI (optional)
- **Serwer** - HTTP, np. Apache or Nginx

---

## Additional Tools

The project can be used in conjunction with the frontend available in the repository [iot-event-hub](https://github.com/Anatolii-Stoliarenko/iot-event-hub.git).

**Frontend Technologies:**

- **Framework:** Angular
- **Backend Communication:** REST API

---

## Installation

1. Clone the repository:

```bash
git clone https://github.com/Anatolii-Stoliarenko/iot-event-backend.git
cd iot-event-backend
```

2. Install dependencies:

```bash
composer install
```

3. Run the Symfony development server:

```bash
symfony serve
```

The application will be available at http://127.0.0.1:8000

---

## Development Tools

Below you will find tools that may be helpful when working with this project:

- **Postman** - for testing API requests.
- **Symfony CLI** - for managing the Symfony project.
- **Composer** - for managing PHP dependencies.
- **VS Code** - recommended IDE with extensions for PHP/Symfony.
- **Git** - for version control management.
- **Docker (optional)** - for quickly setting up the project environment.

---

## Usage

The application handles REST requests through the `/api/event` endpoint. The data sent must conform to the required format for each event. Example events:

---

## Example Request

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

## Example Response

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

## How to Integrate with the Frontend

To integrate with the frontend available in the iot-event-hub repository, you should:

1. Run the backend according to the instructions in the Installation section.
2. Clone and start the frontend project:

```bash
git clone https://github.com/Anatolii-Stoliarenko/iot-event-hub.git
cd iot-event-hub
npm install
npm start
```

3. Ensure that the frontend is configured to communicate with the backend through endpoints available at http://127.0.0.1:8000.

---

## Documentation

**Available Events**

1. `deviceMalfunction` - Handles device malfunctions.
2. `temperatureExceeded` - Handles temperature exceedance.
3. `doorUnlocked` - Handles door unlocking.

Each event undergoes validation and processing based on its type.

---

## License

The LICENSE file contains information regarding the project's license.

---

## Contact

If you have any questions about the project or its setup, contact via:

1. **Email**: [anatolii.stoliarenko@gmail.com](mailto:anatolii.stoliarenko@gmail.com)
2. **Website**: [https://anatolii-stoliarenko.webflow.io/](https://anatolii-stoliarenko.webflow.io/)
