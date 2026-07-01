document.addEventListener('DOMContentLoaded', () => {
    const quantityInputs = document.querySelectorAll('.cart-quantity');

    quantityInputs.forEach((input) => {
        input.addEventListener('change', () => {
            input.closest('form').submit();
        });
    });
});