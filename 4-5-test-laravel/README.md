4. Rate limit diterapkan di folder middleware RateLimit. untuk testing, jalankan script testing Request dengan terminal yang perintahnya: "php test-rate-limit.php"
juga bisa mengecek status rate limit dengan mengakses http://localhost:8000/api/rate-limit. Periksa responsnya untuk melihat status (misalnya, 429 Too Many Requests).

5. File Upload Api diterapkan di Folder Controller Sebagai FileUploadController
bisa di cek dengan Upload file http://localhost:8000/api/upload POST
dan bisa cek untuk getFile http://localhost:8000/api/files/namafile.jpg (jpg, png, etc) GET