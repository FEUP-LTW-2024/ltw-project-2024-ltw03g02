function removeFromCart(index) {
    fetch('../actions/cart/action_remove_from_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            index: index 
        })
    })
    .then(response => response.text()) // parse the response body as text
    .then(data => {
        console.log(data); // log the response body
    })
    .then(() => {
        window.location.reload(true);
    })
    .catch(error => {
        console.error('Failed to remove item from cart:', error);
    });
}

const deleteBtns = document.querySelectorAll('.delete-btn');

deleteBtns.forEach((deleteBtn, index) => {
    deleteBtn.addEventListener('click', () => {
        console.log('delete button pressed ' + index);
        removeFromCart(index);
    });
});