#!/usr/bin/python3
import requests
import random
import sys

base_url = 'http://localhost:8000'

def login(username):
    client = requests.session()
    client.headers['accept'] = 'application/json'

    # get csrf cookie
    url = f"{base_url}/sanctum/csrf-cookie"
    r = client.get(url)
    token = r.cookies.get('XSRF-TOKEN')

    # login
    url = f"{base_url}/login"
    client.headers['X-CSRF-TOKEN'] = token
    data = {
        "email": f"{username}@example.test",
        "password": "password",
        "token_name": "python_" + str(random.randint(10000, 99999)),
    }
    r = client.post(url, data)
    token = r.text
    client.headers['Authorization'] = f"Bearer {token}"

    return client

def article_requests(client):
    url_prefix = f"{base_url}/article"

    def get_request(url):
        status_code = client.get(url).status_code
        print(f"Get resource at {url}")
        print(f"response status_code={status_code}\n")

    def post_request(url, data):
        status_code = client.get(url).status_code
        print(f"Post to resource at {url}")
        print(f"data={data}")
        print(f"response status_code={status_code}\n")

    def del_request(url):
        status_code = client.delete(url).status_code
        print(f"Delete resource at {url}")
        print(f"response status_code={status_code}\n")

    # view requests
    for n in ['', '/1', '/2', '/10']:
        get_request(url_prefix + n)

    # create + update requests
    for n in ['', '/1', '/2', '/10']:
        data = {'title': 'Tail', 'body': 'Once upon a time...', 'author': 'joe'}
        post_request(url_prefix + n, data)

    # delete request
    # actually, the API does not delete, it just pretends to delete.
    # otherwise, it would be necessary to repopulate the db to rerun the example scrip.
    for n in ['/1', '/2', '/10']:
        del_request(url_prefix + n)


def main(argv):
    usernames = ['admin', 'editor', 'manager', 'u1', 'u2']

    argc = len(argv)
    if argc == 1:
        script_name = argv[0]
        print(f"Usage:\t{script_name} <username>")
        print("The script will send http requests in behalf of <username>.")
        print("Those requests are meant to demonstrate the ACL system working.")
        print("<username> can be one of these: ", usernames)
        exit(0)

    if argc != 2:
        print("wrong number of arguments")
        exit(2)

    user = argv[1]
    if user not in usernames:
        print("invalid username")
        exit(3)

    # do stuff
    article_requests(login(user))
    exit(0)


main(sys.argv)
