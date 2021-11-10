from selenium import webdriver
from bs4 import BeautifulSoup
import requests
driver = webdriver.Chrome('D:\chromedriver.exe')
username = 'admin'
password =  '123456aA'
url = 'http://45.79.43.178/source_carts/wordpress/wp-admin'
def LoginithSele():
    driver.get (url)
    usn = driver.find_element_by_id('user_login')
    pwd = driver.find_element_by_id ('user_pass')
    usn.send_keys(username)
    pwd.send_keys(password)
    driver.find_element_by_id('wp-submit').submit()
    print(driver.find_element_by_class_name('display-name').text)
def loginWithRequest():
    payload = {
        'log': 'admin',
        'pwd': '123456aA'
    }
    with requests.Session() as s:
        #url = 'http://45.79.43.178/source_carts/wordpress/wp-admin'
        p=s.post('http://45.79.43.178/source_carts/wordpress/wp-login.php',data=payload)
        soup = BeautifulSoup(p.content,"html.parser")
        results = soup.find('span',class_='display-name')
        print(results.contents)
LoginithSele()
loginWithRequest()
