document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.stars .star');
 
    stars.forEach(star => {
        star.addEventListener('click', (e) => {
            const value = star.getAttribute('data-value'); // Ambil data-value dari bintang yang diklik
            const question = star.parentElement.getAttribute('data-question'); // Ambil pertanyaan yang terkait dengan bintang ini
            const inputField = document.getElementById(`q${question}`); // Cari input hidden yang sesuai dengan pertanyaan
            
            if (inputField) {
                inputField.value = value; // Set nilai dari input hidden sesuai dengan data-value yang dipilih
            }
        });
    });
 });
 