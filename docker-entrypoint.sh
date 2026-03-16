#!/bin/bash

# Get the port from Railway's PORT environment variable, default to 80
PORT=${PORT:-80}

# Replace the port in Apache configuration
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT}/g" /etc/apache2/sites-available/*.conf

# Start Apache
apache2-foreground