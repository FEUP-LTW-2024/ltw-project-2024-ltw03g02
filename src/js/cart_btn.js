function buyBtnPressedHandler(idItem) {
    console.log('buyBtnPressedHandler() executed');
    console.log('buy button pressed');

    fetch('../actions/cart/action_add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'idItem=' + idItem,
    })
    .then(response => response.text())
    .then(data => console.log(data))
    .then(() => {
        document.getElementById('cart-items-num').innerText = parseInt(document.getElementById('cart-items-num').innerText) + 1;
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}