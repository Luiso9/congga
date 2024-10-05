# Perpustakaan Sekolah

Projek guna memenuhi tugas ASKJ

## Acknowledgements

-  [Tachyons CSS](https://tachyons.io)
-  [DataTables](https://datatables.net)

## Deployment

Untuk menjalankan projek ini

```bash
  Buat database dengan nama 'ryujinsayang' dan import sql yang ada di database/ryujinsayang.sql
```

```bash
  Pindahkan direktori projek kedalam xampp/htdocs
```

```bash
  Buka localhost/{NamaDirektori}
```

## Environment Variables

Credentials

`admin@example.com:adminpassword`

## Screenshots

![App Screenshot](https://files.catbox.moe/r5d6x0.png)

## Admin Account

Cara alternatif untuk membuat akun admin kalian cukup memasukan kode ini kedalam SQL Query

```
INSERT INTO admin (FullName, AdminEmail, UserName, Password)
VALUES ('John Doe', 'admin@gmail.com', 'johndoe', MD5('123'));
```
