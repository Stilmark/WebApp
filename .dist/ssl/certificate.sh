sudo cp /usr/lib/ssl/openssl.cnf /usr/lib/ssl/local.cnf

sudo cat /www/WebApp/.dist/ssl/cert.conf >> /usr/lib/ssl/local.cnf

sudo openssl req -x509 -nodes -days 350 -newkey rsa:2048 -sha256 -new  \
    -keyout /www/WebApp/.dist/ssl/web.app.key \
    -out /www/WebApp/.dist/ssl/web.app.crt \
    -reqexts SAN \
    -extensions SAN \
    -config /usr/lib/ssl/local.cnf

sudo service apache2 restart