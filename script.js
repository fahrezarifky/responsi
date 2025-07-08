// Validasi input sebelum submit
document.getElementById('formTambah').addEventListener('submit', function(e) {
    const input = document.getElementById('newItem');
    if (input.value.trim() === '') {
        alert('Masukkan nama item terlebih dahulu!');
        e.preventDefault();
    }
});
