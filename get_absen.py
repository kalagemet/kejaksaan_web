import requests
from bs4 import BeautifulSoup

def main():
	headers = {
		'Access-Control-Allow-Origin': '*',
		'Access-Control-Allow-Headers': 'Content-Type',
		'Access-Control-Max-Age': '3600',
		'User-Agent': 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0'
	}
	url = "https://absensi.kejaksaan.go.id/absen/absensi"
	session = requests.Session()
	req = session.post(url, headers=headers)
	soup = BeautifulSoup(req.content, 'html.parser')
	#print(soup.prettify())
	title = soup.find("title").string
	print(title)
	# if title=="ABSENSI | Login" or title=="ABSENSI | Kadaluarsa":
	# while title!="ABSENSI | Dashboard":
	url = "https://absensi.kejaksaan.go.id/absen/login"
	req = session.get(url, headers=headers)
	token = BeautifulSoup(req.content, 'html.parser')
	token = token.find("input", {"name":"_token"})['value']
	payload = {'username':'admin_30.03','password':'Qwerty1234','_token':token}
	req = session.post(url, headers=headers, data=payload)
	soup = BeautifulSoup(req.content, 'html.parser')
	title = soup.find("title").string
	print(title)
	print(token)
	url = "https://absensi.kejaksaan.go.id/absen/absensi"
	req = session.get(url, headers=headers)
	soup = BeautifulSoup(req.content, 'html.parser')
	token = soup.find("input", {"name":"_token"})['value']
	title = soup.find("title").string
	print(title)
	print(token)
	payload = {
		"_token":token,
		"columns[0][data]": "id_absensi",
		"columns[0][name]": "id_absensi",
		"columns[0][searchable]": "false",
		"columns[0][orderable]": "true",
		"columns[0][search][value]": "",
		"columns[0][search][regex]": "false",
		"columns[1][data]": "DT_RowIndex",
		"columns[1][name]": "DT_RowIndex",
		"columns[1][searchable]": "false",
		"columns[1][orderable]": "false",
		"columns[1][search][value]": "",
		"columns[1][search][regex]": "false",
		"columns[2][data]": "tgl",
		"columns[2][name]": "absensi.tgl",
		"columns[2][searchable]": "true",
		"columns[2][orderable]": "true",
		"columns[2][search][value]": "",
		"columns[2][search][regex]": "false",
		"columns[3][data]": "nama",
		"columns[3][name]": "pegawai.nama",
		"columns[3][searchable]": "true",
		"columns[3][orderable]": "true",
		"columns[3][search][value]": "",
		"columns[3][search][regex]": "false",
		"columns[4][data]": "nip",
		"columns[4][name]": "pegawai.nip",
		"columns[4][searchable]": "true",
		"columns[4][orderable]": "true",
		"columns[4][search][value]": "",
		"columns[4][search][regex]": "false",
		"columns[5][data]": "nama_satker",
		"columns[5][name]": "satker.nama_satker",
		"columns[5][searchable]": "true",
		"columns[5][orderable]": "true",
		"columns[5][search][value]": "",
		"columns[5][search][regex]": "false",
		"columns[6][data]": "in_absen",
		"columns[6][name]": "absensi.in_absen",
		"columns[6][searchable]": "true",
		"columns[6][orderable]": "true",
		"columns[6][search][value]":"",
		"columns[6][search][regex]": "false",
		"columns[7][data]": "in_lokasi",
		"columns[7][name]": "absensi.in_lokasi",
		"columns[7][searchable]": "true",
		"columns[7][orderable]": "true",
		"columns[7][search][value]": "",
		"columns[7][search][regex]": "false",
		"columns[8][data]": "out_absen",
		"columns[8][name]": "absensi.out_absen",
		"columns[8][searchable]": "true",
		"columns[8][orderable]": "true",
		"columns[8][search][value]": "",
		"columns[8][search][regex]": "false",
		"columns[9][data]": "out_lokasi",
		"columns[9][name]": "absensi.out_lokasi",
		"columns[9][searchable]": "true",
		"columns[9][orderable]": "true",
		"columns[9][search][value]": "",
		"columns[9][search][regex]": "false",
		"columns[10][data]": "status",
		"columns[10][name]": "absensi.status",
		"columns[10][searchable]": "true",
		"columns[10][orderable]": "true",
		"columns[10][search][value]": "",
		"columns[10][search][regex]": "false",
		"columns[11][data]": "foto_in",
		"columns[11][name]": "absensi.nip",
		"columns[11][searchable]": "false",
		"columns[11][orderable]": "false",
		"columns[11][search][value]": "",
		"columns[11][search][regex]": "false",
		"columns[12][data]": "foto_out",
		"columns[12][name]": "absensi.nip",
		"columns[12][searchable]": "false",
		"columns[12][orderable]": "false",
		"columns[12][search][value]": "",
		"columns[12][search][regex]": "false",
		"columns[13][data]": "action",
		"columns[13][name]": "action",
		"columns[13][searchable]": "false",
		"columns[13][orderable]": "false",
		"columns[13][search][value]": "",
		"columns[13][search][regex]": "false",
		"order[0][column]": "0",
		"order[0][dir]": "desc",
		"search[value]": "",
		"search[regex]": "false",
		"start": "0",
		"length": "10",
		"day": "26",
		"dayTo": "26",
		"month": "08",
		"monthTo": "08",
		"year": "2022",
		"yearTo": "2022",
		"tipe_satker": "3",
		"satker": "30.03",
		"kdEselon3": ""
	}
	req = session.post(url, headers=headers, data=payload)
	soup = BeautifulSoup(req.content, 'html.parser')
	print(soup.prettify())


if __name__ == "__main__":
    main()