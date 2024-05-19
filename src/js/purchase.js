form.addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(form);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(function(response) {
        if (response.ok) {
            popup.style.display = 'block';
            alert('Produtos comprados com Sucesso! Volta agora para a página inicial');
            window.location.href = 'home_page.php';
        } else {
            console.error('Ocorreu um erro na submissão:', response.statusText);
        }
    })
    .catch(function(error) {
        console.error('Error:', error);
    });
});

homeButton.addEventListener('click', function() {
    window.location.href = 'home_page.php';  // replace with your homepage URL
});