# Running guide
1) `docker-compose up -d`
2) Open `http://localhost:8080/` in your browser (do `ctrl + shift + r` if a db connection error appears)
3) Setup Wordpress
4) Enable "hackmotion" theme
5) Enable "hm_analytics" plugin
6) done!

## Analytics
- The visitor data and events are stored in `hm_visitor_data` and `hm_events` respectively
- You can use PHPMyAdmin to view the tables, which is at `http://localhost:8081/`
