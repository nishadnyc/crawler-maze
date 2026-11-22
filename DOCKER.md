# Run the maze with Docker

One command, from the repo root:

```sh
docker compose up --build
```

Then open <http://localhost:8080>. The homepage, every deep link, the
robots.txt and the sitemap all come from the single `index.php`, routed
by its `.htaccess` — the image is Apache + PHP for exactly that reason
(nginx would ignore the `.htaccess` rules).

Any hostname works: the maze seeds each fake company's identity from
the hostname it is reached by, so `localhost` is one company and any
other host header or domain you point at it is another.

Crawler logs are written to a named Docker volume (`maze-logs`), so
they survive rebuilds. Read them with:

```sh
docker compose exec maze ls /var/www/html/logs
```

Stop it with `docker compose down` (add `-v` to also throw the logs
away).
