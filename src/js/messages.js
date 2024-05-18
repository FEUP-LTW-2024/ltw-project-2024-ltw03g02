document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('message-form');
    var textarea = document.getElementById('message');
    var receiverIdInput = document.getElementById('receiver_id');
    var messagesDiv = document.getElementById('messages');

    // Fetch messages when the page loads
    fetch('../api/get_messages.php')
        .then(response => response.json())
        .then(messages => {
            messages.forEach(message => {
                addMessageToPage(message);
            });
        })
        .catch(function(error) {
            console.error('Error:', error);
        });

    form.addEventListener('submit', function(e) {
        if (textarea.value.trim() === '' || receiverIdInput.value.trim() === '') {
            e.preventDefault();
            alert('Please fill out all fields!');
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
                return response.json();
            } else {
                console.error('Error in submission:', response.statusText);
            }
        })
        .then(function(message) {
            if (message) {
                addMessageToPage(message);
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
    });

    function addMessageToPage(message) {
        var messageDiv = document.createElement('div');

        var senderP = document.createElement('p');
        senderP.textContent = 'From: ' + message.senderId;
        messageDiv.appendChild(senderP);

        var messageP = document.createElement('p');
        messageP.textContent = 'Message: ' + message.message;
        messageDiv.appendChild(messageP);

        var timestampP = document.createElement('p');
        timestampP.textContent = 'Sent at: ' + message.timestamp;
        messageDiv.appendChild(timestampP);

        messagesDiv.appendChild(messageDiv);
    }

    function saveIdUser(idUser) {
        window.idUser = idUser;
        localStorage.setItem('idUser', idUser);
    }

    function getUsername() {
        // Retrieve idUser from local storage or JavaScript variable
        let idUser = localStorage.getItem('idUser') || window.idUser;
    
        // Send AJAX request to server
        fetch('get_user.php?idUser=' + idUser)
            .then(response => response.json())
            .then(user => {
                // Update the h1 element with the username
                document.querySelector('h1').textContent = 'Send a message to ' + user.username;
            });
    }
});