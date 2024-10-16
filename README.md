
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

5. **Start the application: Run the following command to start the Laravel Sail containers:**

    ```
    ./vendor/bin/sail up
    ```


    
