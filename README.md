# About 
This is a simple messenger

# Installation

Run next commands:

1) git clone https://github.com/DMITRII1548/chat.git
2) composer i 
3) npm i

Create .env file and run next command:

4) php artisan key:generate

Add mail, websocket and database configuration to .env file and run next commands:

5) php artisan migrate

6) php artisan storage:link

7) npm run build
