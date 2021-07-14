FROM ubuntu:latest

# WORKDIR /var/www/html

RUN apt-get update;
RUN apt-get install -y systemd less nano unzip curl;

# apache
RUN apt-get install -y apache2; \
    a2enmod ssl; \
    a2enmod rewrite;
COPY zzz-vhosts.conf /etc/apache2/sites-enabled/

# php
RUN apt-get install -y php php-mbstring php-pdo php-gd php-mysqlnd php-intl php-xdebug php-dom
COPY zzz-myphp.ini /etc/php/7.4/apache2/conf.d/

# mariadb
RUN apt-get install -y mariadb-server
COPY zzz-my.cnf /etc/mysql/conf.d/

# adminer
RUN mkdir /var/www/adminer; curl -L https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1-mysql.php > /var/www/adminer/index.php;
COPY .htaccess /var/www/adminer/

RUN systemctl enable apache2
RUN systemctl enable mariadb

# clean
RUN apt-get clean;

# port settings
## http, https
EXPOSE 80 443

# # env settings
# ENV TERM xterm

# bashの設定
RUN echo "alias less='less -r '" | cat >> ~/.bashrc
RUN echo "alias ls='ls -F -G --color=auto'" | cat >> ~/.bashrc
RUN echo "alias rm='rm -i'" | cat >> ~/.bashrc

# RUN timedatectl set-timezone Asia/Tokyo

# start os
CMD ["/lib/systemd/systemd"]
