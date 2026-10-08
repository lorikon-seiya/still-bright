# 1. 基础镜像
FROM php:8.3-cli

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

# 6. 安装依赖 (关键：加入 --no-scripts 避免在 Build 阶段触发 Package Discover 报错)
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs --no-scripts

# 7. 暴露端口
EXPOSE 10000

# 8. 启动命令：在运行时（已注入环境变量）依次执行包发现、缓存清理、数据库迁移和启动服务
CMD php artisan package:discover --ansi && \
    php artisan config:clear && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-10000}