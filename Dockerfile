# 1. 基础镜像：升级为 8.4 (支持 PHP 8.4/8.5 的 Property Hooks 等新语法)
FROM php:8.4-cli

# 2. 安装系统依赖和 PHP 核心扩展
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql mbstring exif pcntl bcmath gd zip

# 3. 安装 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. 设置工作目录
WORKDIR /var/www/html

# 5. 复制项目代码
COPY . .

# 6. 安装依赖
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs --no-scripts

# 7. 暴露端口
EXPOSE 10000

# 8. 启动服务
CMD php artisan package:discover --ansi && \
    php artisan config:clear && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-10000}