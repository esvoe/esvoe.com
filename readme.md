## ESvoe Project

Laravel local install.

**~/.ssh/config**
```
    Host                    95.211.204.15
        Hostname            95.211.204.15
        IdentityFile        ~/.ssh/your_id_rsa
        IdentitiesOnly      yes
```

**Local install**
```
    git clone ssh://git@95.211.204.15:7999/esv/esvoe.git
    composer update
    npm install
```

.env file required for no error "composer update"

/vendor-patch must be applyed after composer update to fix incompability with 5.4 (while waiting official fix)


**Local apache virtual hosts**
```
    <VirtualHost *:80>
       ServerName dev.esvoe.com
       DocumentRoot "/usr/www/dev.esvoe.com/public"
       <Directory "/usr/www/dev.esvoe.com/public">
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
```
```
    <VirtualHost *:80>
       ServerName static.dev.esvoe.com
       DocumentRoot "/usr/www/dev.esvoe.com/storage/uploads"
       <Directory "/usr/www/dev.esvoe.com/storage/uploads">
            Options Indexes FollowSymLinks
            AllowOverride All
            Require all granted
        </Directory>
    </VirtualHost>
```