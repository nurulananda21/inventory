# Inventory System API v1

Base URL: http://localhost:8000/api/v1


## Autentikasi

### POST /register
Mendaftarkan akun pengguna baru.

### POST /login
Masuk ke sistem dan mendapatkan token akses API.


---

## Kategori Barang

### GET /categories
Menarik semua daftar kategori.

### POST /categories
Menambahkan kategori baru.

### GET /categories/{id}
Melihat detail satu kategori.

### PUT /categories/{id}
Memperbarui nama kategori.

### DELETE /categories/{id}
Menghapus kategori (Khusus Admin).


---

## Item Barang

### GET /items

Menarik semua daftar item barang.


### GET /items?category_id={id}

Description:

Endpoint ini digunakan untuk mengambil daftar item berdasarkan kategori tertentu.


Parameter:

- category_id : ID kategori untuk memfilter item


Contoh Request:

GET /api/v1/items?category_id=1


Success Response:

200 OK


{
 "success": true,
 "data": [
   {
    "id":1,
    "name":"Lenovo IdeaPad Slim 1i",
    "quantity":0,
    "price":15000000,
    "category_id":1
   }
 ]
}


Jika kategori tidak memiliki item:

{
 "success": true,
 "data":[]
}


### POST /items

Menambahkan item baru.


### GET /items/{id}

Melihat detail item.


### PUT /items/{id}

Memperbarui item.


### DELETE /items/{id}

Menghapus item.