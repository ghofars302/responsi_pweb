function sendPHP() {
    let orders = [];

    let makanan = document.getElementById("makanan")
    // loop makanan
    for (var i = 0, row; row = makanan.rows[i]; i++) {
        if (row.cells[3] != undefined) {
            var input = row.cells[3].getElementsByTagName('input')[0]
            if (input.checked) {
                orders.push(input.value);
            }
        }
    }

    let minuman = document.getElementById("minuman")
    // loop minuman
    for (var i = 0, row; row = minuman.rows[i]; i++) {
        if (row.cells[3] != undefined) {
            var input = row.cells[3].getElementsByTagName('input')[0]
            if (input.checked) {
                orders.push(input.value);
            }
        }
    }

    let nama = document.getElementsByName("nama")[0].value;
    let alamat = document.getElementsByName("alamat")[0].value;
    let email = document.getElementsByName("email")[0].value;
    let no_hp = document.getElementsByName("no_hp")[0].value;
    let komentar = document.getElementsByName("komentar")[0].value;

    let data = {
        nama: nama,
        alamat: alamat,
        email: email,
        no_hp: no_hp,
        komentar: komentar,
        orders: orders,
        Submit: "Kirim"
    }

    fetch('backend.php', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(async response => {
        if (response.ok) {
            alert("Pesanan berhasil dikirim!");
            window.location.reload();
        } else {
            alert("Pesanan gagal dikirim: " + await response.text());
        }
    }).catch(error => {
        alert("Terjadi error ketika mengirim pesanan!");
    });
}