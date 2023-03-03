#!/usr/bin/python3
import requests
import random

base_url = 'http://localhost:8000'
client = requests.session()
client.headers['accept'] = 'application/json'

# get cookie
url = f"{base_url}/sanctum/csrf-cookie"
r = client.get(url)
token = r.cookies.get('XSRF-TOKEN')

# login
url = f"{base_url}/login"
client.headers['X-CSRF-TOKEN'] = token
data = {
    "email": "u1@example.test",
    "password": "password",
    "token_name": "python_" + str(random.randint(1000, 9999)),
}
r = client.post(url, data)
token = r.text;
print(r.text)

# get profile
url = f"{base_url}/profile"
client.headers["Authorization"] = f"Bearer {token}"
r = client.get(url)
print(r.text)

# article
url = f"{base_url}/article/2"
r = client.get(url)
print(r.status_code)

# logout
url = f"{base_url}/logout"
r = client.post(url)
print(r.text)
