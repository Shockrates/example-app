
# Code.Hub_ Pfizer Bootcamp Full Stack Operations Software Engineer - Final Project Handout - BackEnd.


## Installation 



1. **Clone the Repository & cd to the folder**:

   ```bash
   git clone https://github.com/Shockrates/example-app.git
   cd example-app

2. **Install dependencies**:

    Run Composer install 

    ```bash
    composer install
    ```
    Note: if you don't have Composer installed locally, you can run Composer using Docker:

   ```
   docker run --rm \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php82-composer:latest \
    composer install
   ```
3. **Create a copy of the .env file:**
   ```
   cp .env.example .env
   ```
   Update the database credentials

4. **Generate an application key:**
    
    ```
    ./vendor/bin/sail artisan key:generate
    ```
5. **Run Migrations and Seeders**

    ```
    php artisan migrate:refresh --seed
    ```
    
6. **Start the application: Run the following command to start the Laravel Sail containers:**

    ```
    ./vendor/bin/sail up
    ```
7. **Error Handling**

    If there is an issue with the mysql-1 container starting, run the following commands 
    
    ```
    docker-compose down --volumes
    ```
    ```
    sail up --build
    ```

## Usage

**Endpoints**

| Method | Endpoint               | Description                      |
|--------|------------------------|----------------------------------|
| GET    | `/api/product`               | Fetches a list of porduct          |
| GET    | `/api/product/{id}`          | Fetches a specific product by ID    |
| POST   | `/api/product`               | Creates a new product               |
| PUT    | `/api/product/{id}`          | Updates product information         |
| DELETE | `/api/product/{id}`          | Deletes a product                   |

**Example Request (POST)**
```
{
    "name": "Product vvv",
    "category": "Capsule",
    "batch_number": 731634521,
    "manufacturing_date": "2024-10-01",
    "expiration_date": "2025-10-01",  
    "research_status_id": 1,  <-(1,2 or3)
    "ingredients": [
       { "id": 10, "quantity": 20 },
       { "id": 14, "quantity": 10 }
    ]
}
```

**Example Response (POST)**
```
{
    {
      "message": "Product Found.",
      "data": {
        "id": "9",
        "name": "Lipitor",
        "category": "injection",
        "batch_number": 412453528,
        "research_status": "Completed",
        "manufacturing_date": "2026-09-19T00:00:00.000000Z",
        "expiration_date": "2027-05-06T00:00:00.000000Z",
        "ingredients": [
          {
            "name": "Silicon Dioxide",
            "quantity": 5
          },
          {
            "name": "Croscarmellose Sodium",
            "quantity": 5
          }
        ]
      }
    }
}
```
