# 使用官方 PHP 8.3 + Nginx 镜像或基础镜像
FROM php:8.3-cli

# 1. 安装系统依赖和 PostgreSQL / MySQL 扩展
RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip unzip git \
    && docker-php-ext-install pdo pdo_pgsql pdo_mysql

# 2. 安装 Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. 设置工作目录并复制项目文件
WORKDIR /var/www/html
COPY . .

# 4. 安装生产环境依赖 (忽略开发依赖)
RUN composer install --no-dev --optimize-autoloader

# 5. 优化缓存 (配置、路由、视图)
RUN php artisan config:clear && php artisan route:cache && php artisan view:cache

# 6. Render 会自动注入 PORT 环境变量（默认 10000）
EXPOSE 10000

# 7. 启动前自动跑数据库迁移，并启动服务
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}