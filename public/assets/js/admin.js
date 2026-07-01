document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('productSearch');

    if (!searchInput) {
        return;
    }

    searchInput.addEventListener('keyup', () => {
        const value = searchInput.value.toLowerCase();

        document.querySelectorAll('#productsTable tbody tr').forEach((row) => {
            row.style.display = row.textContent.toLowerCase().includes(value)
                ? ''
                : 'none';
        });
    });
});