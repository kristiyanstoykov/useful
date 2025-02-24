## Replace line endings from windows to linux in a bash script

```
sudo sed -i 's/\r$//' script.sh
```

## Generate self signed ssl certificate for local development

```
sudo openssl req -x509 -nodes -days 365 \
  -newkey rsa:2048 \
  -keyout /etc/ssl/private/local.example.bg.key \
  -out /etc/ssl/certs/local.example.bg.crt
```

### This is an example config file without the ssl but with redirection to https

```
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /home/user/public_html/angelic-glow
    ServerName local.example.bg

    RewriteEngine on
    RewriteCond %{SERVER_NAME} =local.example.bg
    RewriteRule ^ https://%{SERVER_NAME}%{REQUEST_URI} [END,NE,R=permanent]

    <Directory /home/user/public_html/angelic-glow>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

### This is an example config file with ssl

```
<VirtualHost *:443>
    ServerAdmin webmaster@localhost
    DocumentRoot /home/user/public_html/angelic-glow
    ServerName local.example.bg

    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/local.example.bg.crt
    SSLCertificateKeyFile /etc/ssl/private/local.example.bg.key

    <Directory /home/user/public_html/angelic-glow>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
