<?php
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);

    if (isset($data['Submit'])) {
        $nama = $data['nama'];
        $email = $data['email'];
        $alamat = $data['alamat'];
        $no_hp = $data['no_hp'];
        $komentar = $data['komentar'];
        $orders = $data['orders'];

        // check $orders array length
        if (count($orders) == 0) {
            http_response_code(400);
            header('Content-Type: text/plain');
            echo 'Anda harus memilih produk yang ingin dipesan!';
            return;
        }
        
        // Agar tidak terjadi XSS
        $nama = filter_var($nama, FILTER_SANITIZE_STRING);
        if ($nama == "") {
            http_response_code(400);
            header('Content-Type: text/plain');
            echo 'Nama tidak boleh kosong';
            return;
        }

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if ($email == "") {
            http_response_code(400);
            header('Content-Type: text/plain');
            echo 'Email tidak boleh kosong';
            return;
        }

        $alamat = filter_var($alamat, FILTER_SANITIZE_STRING);
        if ($alamat == "") {
            http_response_code(400);
            header('Content-Type: text/plain');
            echo 'Alamat tidak boleh kosong';
            return;
        }

        $no_hp = filter_var($no_hp, FILTER_SANITIZE_NUMBER_INT);
        if ($no_hp == '') {
            http_response_code(400);
            header('Content-Type: text/plain');
            echo 'No HP tidak boleh kosong';
            return;
        }

        $komentar = filter_var($komentar, FILTER_SANITIZE_STRING);

        $file = fopen("./daftar_orderan.txt", "a");
        $str = "$nama|$email|$alamat|$no_hp|$komentar|";
        foreach ($orders as $order) {
            $str .= $order . ',';
        }   
        fwrite($file, $str . "\n");
        fclose($file);
    } else {
        http_response_code(400);
        header('Content-Type: text/plain');
        echo "Bad Request";
    }
?>