FROM php:8.2-cli

# Install required PHP extensions
RUN docker-php-ext-install curl

# Copy website files
COPY . /app/

# Set working directory
WORKDIR /app

# Start PHP built-in server on Railway's PORT
CMD ["sh", "-c", "php -S 0.0.0.0:$PORT -t ."]