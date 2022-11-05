# WebApp

Clone to a project destination in your vhost directory.

### Install ###

Run the install script to require dependencies and set up configuration files and directory permissions.

```shell
./install.sh
```
    
### Configure ###

Edit .env file.

### Create Multipass instance ###

```shell
multipass launch --cpus 1 --disk 10G --mem 1G --name master \
multipass mount /Users/$USER/www master:/www \
multipass connect master
```

```shell
sudo apt update \
sudo apt -y upgrade \
sudo apt -y install apache2 php libapache2-mod-php php-cli php-mbstring unzip \
sudo systemctl restart apache2
```

```shell
sudo a2enmod rewrite \
sudo service apache2 reload \
sudo service apache2 restart
```

```shell
cd ~ \
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php \
sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer
```
