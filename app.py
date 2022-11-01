
from flask import Flask,render_template,request,session, abort,send_file,send_from_directory,redirect,url_for,make_response
import io; 
import csv
import selenium
from selenium import webdriver
import time
import os
import re
import random
from selenium.webdriver.common.keys import Keys
from selenium.common.exceptions import NoSuchElementException
import pandas as pd
from selenium.webdriver.chrome.options import Options
import threading
from multiprocessing import Process
from threading import Thread
import mysql.connector
import datetime
from datetime import datetime


def mysqlfunction():
    mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="sample"
)

    return mydb

app = Flask(__name__)
app.secret_key = 'sainath123567'

# @app.route('/',methods=["POST","GET"])
# def hello_name():
#     error=""
#     success=""
#     print("hello")
#     mycursor=mydb.cursor()
#     sql="SELECT * FROM sample"
#     mycursor.execute(sql)
#     results=mycursor.fetchall()
#     mydb.commit()
#     print(results)
#     if request.method=='POST':
#         empid=request.form.get("empid")
#         empname=request.form.get("empname")
#         place=request.form.get("place")
#         address=request.form.get("address")
#         print(empid)
#         mycursor=mydb.cursor()

#         sql="SELECT empid FROM sample where empid="+empid+""
#         mycursor.execute(sql)
#         result=mycursor.fetchone()
#         print(result)
#         if result:
#             error="Id already exists"
#             print(error)       
#         else:
#             sql="INSERT INTO sample(empid,empname,place,address) VALUES (%s,%s,%s,%s)"
#             val= (empid,empname,place,address)
#             mycursor.execute(sql,val)
#             mydb.commit()
#             success="Regsitered successfully"
#         return render_template('index.php',results=results,error=error,success=success)
#     return render_template('index.php',results=results)


@app.route('/',methods=["POST","GET"])
def hello_name():
    error=""
    success=""
    print("hello")
    mydb=mysqlfunction()
    mycursor=mydb.cursor()
    sql="SELECT * FROM sample"
    mycursor.execute(sql)
    results=mycursor.fetchall()
    mydb.commit()
    mycursor.close()
    print(results)
    return render_template('index.php',results=results)

@app.route('/ajaxtesting',methods=["POST"])
def ajaxtesting():
    
    if request.method=="POST":
        data1=request.get_json()  
        empid=data1['empid']
        name=data1['name']
        city=data1['city']
        address=data1['address']
        mydb=mysqlfunction()
        mycursor=mydb.cursor()
        sql="INSERT INTO sample(empid,empname,place,address) VALUES (%s,%s,%s,%s)"
        val= (empid,name,city,address)
        mycursor.execute(sql,val)
        mydb.commit()
        mycursor.close()
        success="Regsitered successfully"
        print(success)
        return render_template("index.php",success=success)
    else:
        return redirect("/")
    
    # error=""
    # success=""
    # print("hello")
    # mycursor=mydb.cursor()
    # sql="SELECT * FROM sample"
    # mycursor.execute(sql)
    # results=mycursor.fetchall()
    # mydb.commit()
    # print(results)
    
    # mycursor=mydb.cursor()
    # sql="SELECT empid FROM sample where empid="+empid+""
    # mycursor.execute(sql)
    # result=mycursor.fetchone()
    # print(result)
    # if result:
    #     error="Id already exists"
    #     print(error)       
    # else:
    #     sql="INSERT INTO sample(empid,empname,place,address) VALUES (%s,%s,%s,%s)"
    #     val= (empid,empname,place,address)
    #     mycursor.execute(sql,val)
    #     mydb.commit()
    #     success="Regsitered successfully"
    
    

@app.route("/about",methods=["POST",'GET'])
def sainath():
    if request.method=='POST':
        empid=request.form.get("empid")
        empname=request.form.get("empname")
        place=request.form.get("place")
        address=request.form.get("address")
        print(empid)
        mydb=mysqlfunction()
        mycursor=mydb.cursor()
        sql="SELECT empid FROM sample where empid="+empid+""
        mycursor.execute(sql)
        result=mycursor.fetchone()
        print(result)
        if result:
            error="Id already exists"
            print(error)       
        else:
            sql="INSERT INTO sample(empid,empname,place,address) VALUES (%s,%s,%s,%s)"
            val= (empid,empname,place,address)
            mycursor.execute(sql,val)
            mydb.commit()
    return redirect(url_for('hello_name'))

@app.route("/pagination",methods=["POST",'GET'])
def pagination():
    error=""
    pgno=request.args.get("pgno")
    mydb=mysqlfunction()
    mycursor=mydb.cursor()
    sql="SELECT * FROM sample LIMIT "+str(pgno)+",10"
    mycursor.execute(sql)
    result=mycursor.fetchall()
    print(result)
    if len(result)==0:
        error="No Data Exist"
    else :
        error=""
    return render_template("pagination.php",pgno=pgno,result=result,error=error)

@app.route("/searchbyid",methods=["POST","GET"])
def searchbyid():
    if request.method=='POST':
        empid=request.form.get("serachname")
        mydb=mysqlfunction()
        mycursor=mydb.cursor()
        sql="SELECT * FROM sample WHERE empid="+empid+""
        mycursor.execute(sql)
        result=mycursor.fetchall()
        print(result)
        return render_template("pagination.php",result=result)

@app.route("/downloadexcel",methods=["POST","GET"])
def download():
    filename="mydata"
    pgno=request.args.get("pgno")
    print(pgno)
    mydb=mysqlfunction()
    mycursor=mydb.cursor()
    sql="SELECT * FROM sample LIMIT "+pgno+" , 10"
    mycursor.execute(sql)
    result=mycursor.fetchall()
    print(result)
    df = pd.DataFrame(result,columns=['ID','Empid','name','Place','address'])
    print(df)
    filename=finalname+'-on''-['+str(datetime.now().strftime('%d-%m-%Y , %H-%M-%S')) +']'
    df.to_excel("static//files/"+filename+".xlsx")
    filepath='static/files'
    return send_from_directory(filepath,filename+'.xlsx',as_attachment=True)


    
if __name__ == '__main__':
   app.run(debug=True)