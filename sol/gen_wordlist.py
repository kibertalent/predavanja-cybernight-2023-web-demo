#!/usr/bin/env python3
from itertools import product # Fancy :)


# simple rockyou.txt

b1 = [
    "Pomlad", "Jesen",
    "Poletje", "Zime",
]

b2 = [
    str(x) for x in range(2016, 2024)
]

b3 = [
    "","!","?","#","1"
]

for i in product(b1, b2, b3):
    print("".join(i))
