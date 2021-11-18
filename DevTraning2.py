import csv
import mysql.connector
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="LiteDb"
)
mycursor = mydb.cursor()
#mycursor.execute("CREATE TABLE customers (id int primary key,Fname VARCHAR(50),Lname VARCHAR(50), bLaddress1 VARCHAR(50),bLaddress2 VARCHAR(50),city VARCHAR(30),state VARCHAR(10),postalcode int,country VARCHAR(30),phone VARCHAR(20),email VARCHAR(100),createddate VARCHAR(50))")
with open('E:\customer.csv') as csv_file:
    csv_reader = csv.reader(csv_file, delimiter=',')
    for i in csv_reader:
        sql = "INSERT INTO customers (id  ,Fname ,Lname, bLaddress1,bLaddress2 ,city ,state ,postalcode ,country ,phone ,email ,createddate) VALUES (%i,%s,%s,%s,%s,%s,%s,%i,%s,%s,%s,%s)"       
        val = ()
        for j in i:
            addedTup = (j,)
            val += addedTup
        print(len(val))
        mycursor.execute(sql, val)
        mydb.commit()


