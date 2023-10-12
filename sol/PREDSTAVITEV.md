# Predstavitev


1. Pokaži HTTP in raw http socket

    rabimo: brain
    - Povedat da je to stateless
    rabimo: nc, curl
    - Najprej pokažemo s curlom, potem pogledamo v developer tools, potem pa še z nc
    ```bash
    curl -v http://www.google.com
    nc www.google.com 80
    GET / HTTP/1.1
    Host: www.google.com

    ```

69. Registracija vsak svojega uporabnika
    
    rabimo: burp suite
    - Pogledamo v developer tools, kaj se zgodi, ko se registriramo
    - Pogledamo v burp suite, kaj se zgodi, ko se registriramo
    - HTTP POST/GET itd.


420. Developer tools + slajdi za cookie
    rabimo: cyberchef
    Poglejmo kaj sedogaja s cookijem

1337. Malo od b64, json, kaj bi lahko spremenili.

80085. ( . )( . )  dobimo admin in probamo privesc


# Bruteforce

1. Show `gen_wordlist.py`

    `./sol/gen_wordlist.py > sol/wordlist `


2. Show john

    `john --format=bcrypt --wordlist=sol/wordlist sol/passwordfile.txt`

    `john --format=raw-md5 --wordlist=sol/wordlist sol/passwordfile.txt`

    `john --show sol/passwordfile.txt `
    
    Povrsti:
    - plain -> slabo
    - (encryption kinda bad)
    - hashanje -> must
    - salting -> super (da ni rainbow tablov)
    - iteracije -> super (da je počasno)
    - npt. bcrypt, blowfish, scrypt, pbkdf2, argon2, ...

3. 