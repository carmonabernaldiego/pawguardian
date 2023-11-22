# Crear y configurar un nuevo Virtual Host
sudo mkdir -p /var/www/localhost
sudo chown -R www-data:www-data /var/www/localhost
sudo chmod -R 755 /var/www/localhost

# Crear archivo de configuración del Virtual Host
sudo bash -c 'cat << EOF > /etc/apache2/sites-available/localhost.conf
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/localhost
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF'

# Habilitar el nuevo sitio y recargar Apache
sudo a2ensite localhost
sudo a2dissite 000-default
sudo systemctl reload apache2

# Crear un archivo HTML de prueba
sudo bash -c 'cat << EOF > /var/www/localhost/index.html
<html>
  <head>
    <title>Diego Carmona Bernal</title>
  </head>
  <body>
    <h1>Configurado por Diego Carmona Bernal</h1>
  </body>
</html>
EOF'