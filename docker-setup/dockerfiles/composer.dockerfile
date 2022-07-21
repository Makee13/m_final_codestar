FROM composer:latest

WORKDIR /var/www/html

# This ensures that we can run this without any warnings
ENTRYPOINT ["composer", "--ignore-platform-reqs"]