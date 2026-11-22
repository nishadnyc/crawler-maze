# Crawler Maze — one PHP file, served by Apache so .htaccess works.
# The maze's routing lives in .htaccess (mod_rewrite), so this must be
# an Apache image: nginx / php-fpm would ignore the rules entirely.
FROM php:8.3-apache

# .htaccess support: rewrite engine on, per-directory overrides allowed.
RUN a2enmod rewrite
COPY docker/apache-maze.conf /etc/apache2/conf-available/maze.conf
RUN a2enconf maze

# The maze itself: the script, its routing rules, and the logs folder
# guard. Everything else in the repo (README, docs, logs data) stays out.
COPY index.php .htaccess /var/www/html/
COPY logs/.htaccess /var/www/html/logs/.htaccess

# At runtime the script writes logs/*.json and its state files
# (.maze-bans.json, .maze-visitors.json) beside itself, so the web
# root must be writable by the Apache user.
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
