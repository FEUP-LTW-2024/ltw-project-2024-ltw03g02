document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('chat-form');
    var textarea = document.getElementById('chat-input');
    var popup = document.getElementById('success-popup');
    var chatContainer = document.getElementById('chat-container');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (textarea.value.trim() === '') {
            alert('Please enter a message!');
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
});

function saveIdUser(idUser) {
    localStorage.setItem('idUser', idUser);
}