import requests
from bs4 import BeautifulSoup
import json
import re

def main():
    # Opening JSON file
    f = open('shania.json')
    # returns JSON object as 
    # a dictionary
    data = json.load(f)
    # Iterating through the json
    # list
    for i in data['data2020']:
        if i[3]=='Tender Sudah Selesai':
            tmp = i[4].split()
            if tmp[1]=="M":
                get( i[0], re.sub('<[^>]+>', '', i[1]).replace('/',' '))
    # Closing file
    f.close()

def get(id, title):
    print("mengambil "+str(id)+" ."+str(title))
    headers = {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Allow-Headers': 'Content-Type',
        # 'Access-Control-Max-Age': '3600',
        'Connection': 'keep-alive',
        'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0',
        # 'Cookie' : 'SPSE_SESSION=3dcb15be802f34b67457119c2d35fb11333d15fd-___AT=0467c0e3461724b216b2965fb183755871180db1&___TS=1662778845533&___ID=53ae6590-a68d-4831-9497-db94150afce8'
        'Cookie' : 'SPSE_SESSION=9f7564faf32a84bdf576265fb5cfa1e7683d3129-___AT=0467c0e3461724b216b2965fb183755871180db1&___TS=1662782774753&___ID=53ae6590-a68d-4831-9497-db94150afce8'
    }
    url = "http://36.92.219.201/eproc4/lelang/"+str(id)+"/"
    url2 = "http://36.92.219.201/eproc4/evaluasi/"+str(id)+"/"
    param = ['pengumumanlelang','peserta','hasil','pemenang','pemenangberkontrak']
    session = requests.Session()
    data = '<!DOCTYPE html><html lang="en"><head><link rel="stylesheet" href="shania.css"  /><style >.content {margin : 50px}</style></head><body >'
    for i in param:
        tmp_url = url2
        if i == 'pengumumanlelang' or i == 'peserta':
            tmp_url = url
        tmp_url = tmp_url+i
        req = session.post(tmp_url, headers=headers)
        soup = BeautifulSoup(req.content, 'html.parser')
        #print(soup.prettify())
        tmp = soup.find("div", {"class": "content"})
        # print(tmp)
        data = data+str(tmp)
    data = data+"</body>"
    file = open("hasil2020/"+str(title)+'.html','w+')
    file.write(data)
    file.close()
    print(str(id)+" ."+str(title)+" selesai")


if __name__ == "__main__":
    main()