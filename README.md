# TP3DPBO2023
Saya Raisyad Jullfikar NIM 2106238 mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi Tugas
Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:
* Program bebas, kecuali program Ormawa
* Menggunakan minimal 3 buah tabel
* Terdapat proses Create, Read, Update, dan Delete data
* Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas)
* Menggunakan template/skin form tambah data dan ubah data yang sama
* 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
* Menggunakan template/skin tabel yang sama untuk menampilkan tabel

## Desaign Program
<img width="413" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/233e528f-f47c-4f62-b5a9-27087afbec28">

Pada program ini terdapat 3 tabel yaitu:
1. Tabel User yang berisi 9 atribut dengan atribut `user_id` sebagai primary keynya. Tabel ini memiliki relasi many to one dengan tabel Monitor dimana foreign keynya ada pada atribut`monitor_id` dan juga berelasi many to one dengan tabel keyboard dimana foreign keynya ada pada atribut `keyboard_id`.
2. Tabel Monitor berisi 2 atribut dengan atribut `monitor_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel User
3. Tabel Keyboard berisi 2 atribut dengan atribut `keyboard_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel User.

## Alur Program
1. Ketika pertama kali user membuka web/mengaksesnya, pengguna akan diarahkan pada halaman home/index yang berisi kumpulan data user yang tersedia di database. Pada navbar terdapat navigasi untuk berpindah ke halaman tambah user, monitor, dan keyboard, juga terdapat search untuk mencari data user serta dropdown untuk pilihan filter, misalnya untuk mengurutkan berdasarkan data user terbaru, terlama, dan pembelian billing user tertinggi/terlama. Data user yang ditampilkan dapat diklik untuk melihat data user secara lebih detail.
2. Jika Client mengklik navbar bertuliskan home :
   - Client diberikan data user yang merupakan kumpulan data dari table user di database.
   - Jika Client mengklik salah satu card data yang diberikan, maka Client akan dialihkan ke halaman detail yang mana akan menampilkan data keseluruhan dari data user yang dituju.
   - Jika Client mengklik button delete yang terdapat pada halaman detail ketika Client mengklik salah satu card pada halaman home tadi, maka Client akan menghapus data yang dituju tersebut.
   - Jika Client mengklik button edit yang terdapat pada halaman detail ketika Client mengklik salah satu card pada halaman home tadi, maka Client akan dialihkan ke halaman edit dari data yang dituju.
   - Jika Client ingin melakukan pencarian data, Client dapat mengisi sebuah textfield pencarian di atas kanan.
   - Jika Client ingin melakukan pemfilteran data, Client dapat mengklik sebuah icon Filter dropdown di bawah string yang bertuliskan "Daftar Users ICAFE", dan akan menerima 3 pilihan (Newest, Oldest, Highest Billing).
4. Jika Client mengklik navbar bertuliskan Tambah user :
   - Client akan dialihkan kehalaman form/tambah data untuk menambahkan data user.
6. Jika Client mengklik navbar bertuliskan Daftar Monitor :
   - Client akan dialihkan kehalaman monitor dengan data monitor yang disajikan berupa table.
   - Jika Client ingin menambah data terkait monitor, Client dapat mengisi sebuah textfield disebelah kanan.
   - Jika Client ingin mengedit/mengubah sebuah data, Client dapat mengklik Icon edit yang berwarna kuning dan textfield disebelah kanan akan berubah menjadi edit dengan value textfieldnya itu dari value data yang dituju oleh Client.
   - Jika Client ingin menghapus sebuah data, Client dapat mengklik icon hapus yang berwarna merah, dan jika data tersebut sedang digunakan oleh user, maka data yang ingin dihapus oleh Client tidak bisa terhapus.
   - Jika Client ingin melakukan pencarian data, Client dapat mengisi sebuah textfield pencarian di atas kanan.
   - Jika Client ingin melakukan pemfilteran data, Client dapat mengklik sebuah icon Filter dropdown di table header paling kanan, dan akan menerima 3 pilihan (Newest, Oldest, Highest HZ)
7. Jika Client mengklik navbar bertuliskan Keyboard :
   - Client akan dialihkan kehalaman keyboard dengan data keyboard yang disajikan berupa table.
   - Jika Client ingin menambah data terkait keyboard, Client dapat mengisi sebuah textfield disebelah kanan.
   - Jika Client ingin mengedit/mengubah sebuah data, Client dapat mengklik Icon edit yang berwarna kuning dan textfield disebelah kanan akan berubah menjadi edit dengan value textfieldnya itu dari value data yang dituju oleh Client.
   - Jika Client ingin menghapus sebuah data, Client dapat mengklik icon hapus yang berwarna merah, dan jika data tersebut sedang digunakan oleh user, maka data yang ingin dihapus oleh Client tidak bisa terhapus.
   - Jika Client ingin melakukan pencarian data, Client dapat mengisi sebuah textfield pencarian di atas kanan.
   - Jika Client ingin melakukan pemfilteran data, Client dapat mengklik sebuah icon Filter dropdown di table header paling kanan, dan akan menerima 3 pilihan (Newest, Oldest, Lowest)

## Dokumentasi
Halaman Home
<img width="960" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/03c4075d-cebe-4f03-85f9-8b2eeeca4959">

Halaman Detail
<img width="960" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/e9b6a9ed-9084-482a-a5e9-de47ab553b5b">

Tambah User
<img width="959" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/862ca404-4c37-4a3b-ad3e-6d93cc46a83d">

Update User
<img width="960" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/8349673a-29fc-4dab-8e7f-5ab19210a958">

Monitor Home
<img width="960" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/b3e06ad9-840e-4075-9a37-fd2aec34a4fa">

Monitor Update
<img width="960" alt="update_monitor" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/727b02a2-b6e6-4316-b9e0-a6b0621c61f0">

Keyboard Home
<img width="960" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/f8200d22-92ab-4622-832f-2ec7dab14a17">

Keyboard Update
<img width="960" alt="image" src="https://github.com/raisyad/TP3DPBO2023C2/assets/92106283/4573daa6-0220-40b1-93aa-275b05a5daf1">

Preview Video :
https://github.com/raisyad/TP3DPBO2023C2/blob/main/preview_video.mp4
(diatas)
