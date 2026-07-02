document.addEventListener('DOMContentLoaded', () => {
    const quantityInputs = document.querySelectorAll('.cart-quantity');

    quantityInputs.forEach((input) => {
        input.addEventListener('change', () => {
            input.closest('form').submit();
        });
    });

    const checkoutButton = document.getElementById('checkoutButton');
    const checkoutModal = document.getElementById('checkoutModal');
    const closeCheckoutModal = document.getElementById('closeCheckoutModal');

    if (checkoutButton && checkoutModal && closeCheckoutModal) {
        checkoutButton.addEventListener('click', () => {
            checkoutModal.hidden = false;
        });

        closeCheckoutModal.addEventListener('click', () => {
            checkoutModal.hidden = true;
        });

        checkoutModal.addEventListener('click', (event) => {
            if (event.target === checkoutModal) {
                checkoutModal.hidden = true;
            }
        });
    }
});