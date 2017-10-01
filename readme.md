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
