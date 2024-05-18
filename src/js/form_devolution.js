document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('client-form');
    var textarea = document.getElementById('support');
    var popup = document.getElementById('success-popup');
    var homeButton = document.getElementById('go-home');

    form.addEventListener('submit', function(e) {
        if (textarea.value.trim() === '') {
            e.preventDefault();
            alert('Write anything!');
            return;
        }
        e.preventDefault();
        var formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(function(response) {
            if (response.ok) {
                popup.style.display = 'block';
            } else {
                console.error('Ocorreu um erro na submissão:', response.statusText);
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
    });

    homeButton.addEventListener('click', function() {
        window.location.href = '/../pages/home_page.php';  // replace with your homepage URL
    });
});