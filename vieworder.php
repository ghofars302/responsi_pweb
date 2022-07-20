<!DOCTYPE HTML>
<html>
    <head>
        <!--load style-->
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    </head>
    <body>
        <header>
            <div class="container light">
                <h1>Rumah makan gk genah</h1>
                <b>Harga terjangkau dan murah delivery</b>
            </div>
            <br/>
            <div class="container light">
                <h2>Daftar-Daftar yang beli makanan</h2>
            </div>
            <br/>
        </header>
        <main>
            <div class="container light rounded">
                <table border="1">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Alamat</td>
                        <td>No. HP</td>
                        <td>Pembelian</td>
                        <td>Catetan</td>
                        <td>Total</td>
                    </tr>
                    <?php
                        $pricejson = file_get_contents('./item.json');
                        $price = json_decode($pricejson, true);
                        $no = 1;
                        $total = 0;
                        $guessbook = fopen("daftar_orderan.txt", "r");
                        while ($isi = fgets($guessbook, 80)) {
                            $split = explode("|", $isi);
                            // check array length
                            if (count($split) == 6) {
                                $nama = $split[0];
                                $email = $split[1];
                                $alamat = $split[2];
                                $no_hp = $split[3];
                                $komentar = $split[4];
                                $orders = explode(",", $split[5]);
                                $total = 0;
                                echo "<tr>";
                                echo "<td>$no</td>";
                                echo "<td>$nama</td>";
                                echo "<td>$email</td>";
                                echo "<td>$alamat</td>";
                                echo "<td>$no_hp</td>";
                                echo "<td>";
                                foreach ($orders as $order) {
                                    if ($order != '') {
                                        echo $order . "<br/>";
                                        foreach ($price as $item) {
                                            if ($item['Item'] == $order) {
                                                $total += $item['Price'];
                                            }
                                        }
                                    }
                                }
                                echo "</td>";
                                echo "<td>$komentar</td>";
                                echo "<td>$total</td>";
                                echo "</tr>";
                                $no++;
                            }
                        }
                        fclose($guessbook);
                    ?>
                </table>
                <br>
            </div>
        </main>
        <footer>
            <div class="container light">
                <p>&copy; Copyright 2022 | Ghofar Raihananda Suprapto</p>
            </div>
        </footer>
    </body>
</html>