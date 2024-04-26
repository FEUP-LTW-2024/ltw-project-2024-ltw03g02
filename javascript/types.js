function fetchItemsByType(id) {
    var card = document.getElementById(id);
    card.addEventListener('click', function() {
        var type = this.querySelector('h3').textContent;
        window.location.href = 'get_item_type.php?type=' + encodeURIComponent(type);
    });
}