FROM adminer:4.7.6

USER root
RUN apk update \
    && apk add --no-cache bash autoconf build-base composer libaio libnsl libc6-compat busybox-extras \
    && curl -o /tmp/instantclient.zip https://download.oracle.com/otn_software/linux/instantclient/211000/instantclient-basic-linux.x64-21.1.0.0.0.zip \
    && curl -o /tmp/sqlplus.zip https://download.oracle.com/otn_software/linux/instantclient/211000/instantclient-sqlplus-linux.x64-21.1.0.0.0.zip \
    && curl -o /tmp/sdk.zip https://download.oracle.com/otn_software/linux/instantclient/211000/instantclient-sdk-linux.x64-21.1.0.0.0.zip \
    && unzip -d /usr/local/ /tmp/instantclient.zip  && unzip -d /usr/local/ /tmp/sqlplus.zip \
    && unzip -d /usr/local/ /tmp/sdk.zip \
    && ln -s /usr/lib/libnsl.so.2 /usr/lib/libnsl.so.1 \
    && ln -s /lib/libc.so.6 /usr/lib/libresolv.so.2 \
    && ln -s /lib64/ld-linux-x86-64.so.2 /usr/lib/ld-linux-x86-64.so.2 \
    && pear upgrade --force  && pecl upgrade  && mkdir -p /etc/php.d/ \
    && echo "extension=oci8.so" > /etc/php.d/instantclient.ini \
    && docker-php-ext-configure oci8 --with-oci8=instantclient,/usr/local/instantclient_21_1 \
    && docker-php-ext-install oci8 \
    && rm -rf /tmp/*.zip /var/cache/apk/* /tmp/pear/

USER adminer