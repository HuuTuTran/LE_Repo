import csv
import requests
import pandas as pd
import json
url  = 'https://a3f749ceda5325bcea1a4a3cad5ffeae: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@huututran.myshopify.com/admin/api/2021-10/customers.json'
rsl = requests.get(url).text
a_json_object = json.loads(rsl)
jsonlst =  a_json_object['customers']
input = [] 
for i in jsonlst:
    for key in i:
        if key != "addresses" and key != "":
            print(f"{key}=>{i[key]}")
            input.append(str(i[key]))
with open('D:\Python\LE_Repo\cus.csv', mode='w') as employee_file:
    employee_writer = csv.writer(employee_file, delimiter=',', quotechar='"', quoting=csv.QUOTE_MINIMAL)
    employee_writer.writerow(["id","email","accepts_marketing","created_at","updated_at","first_name","last_name","orders_count","state","total_spent","last_order_id","note","verified_email","multipass_identifier","tax_exempt","phone","tags","last_order_name","currency"])
    employee_writer.writerow(input)