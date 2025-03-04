# Welcome to 0x0.kr
This is the **main page** of 0x0.kr. Follow the steps below to **set up the server** with MySQL, Nginx, and PHP-FPM (7.4).

## Requirements
You need to install the following:
- **MySQL**
- **Nginx**
- **PHP-FPM 7.4**

## 1. Install & Configure MySQL
### Install MYSQL
```
sudo apt update
sudo apt install mysql-server -y
sudo mysql_secure_installation
sudo mysql -u root -p
sudo systemctl restart mysql
```
### Set Up MySQL Database & User
```
CREATE DATABASE creds;
USE creds;
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE USER 'admin'@'localhost' IDENTIFIED BY 'Qwer1234**';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;
EXIT;
```

## 2. Install & Configure Nginx
### Install Nginx
```
sudo apt install nginx
sudo nano /etc/nginx/sites-available/default
```
### Configure Nginx for PHP
Change the code as below.
```
server {
        listen 80 default_server;
        listen [::]:80 default_server;

        root /var/www/html;

        index index.php index.html index.htm index.nginx-debian.html;

        server_name _;

        location / {
                try_files $uri $uri/ =404;
        }

        location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/run/php/php7.4-fpm.sock;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                include fastcgi_params;
        }
}
```
### Restart Nginx
```
sudo systemctl restart nginx
```
## 3. Install & Configure PHP 7.4
### Install PHP 7.4 and Required Extensions
```
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install php7.4 php7.4-fpm php7.4-cli php7.4-mysql php7.4-curl php7.4-mbstring php7.4-xml php7.4-zip -y
```
### Enable & Start PHP-FPM
```
sudo systemctl start php7.4-fpm
sudo systemctl enable php7.4-fpm
sudo systemctl restart php7.4-fpm
```

