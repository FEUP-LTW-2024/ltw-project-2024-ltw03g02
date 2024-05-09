const edit_btns = document.querySelectorAll('.edit-btn');
for (let btn of edit_btns) {
    btn.addEventListener('click', (e) => {
        const btnId = e.currentTarget.id;
        const id = btnId.split('-')[2];
        const input = document.getElementById("idUser-input-edit");
        input.value = id;
        
        window.location.href = "#edit-user-section";

    });
}

const del_btns = document.querySelectorAll('.delete-btn');
for (let btn of del_btns) {
    btn.addEventListener('click', (e) => {
        const btnId = e.currentTarget.id;
        const idUser = btnId.split('-')[2];
        console.log("id: " + idUser);
        fetch('../actions/action_del_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idUser: idUser })
        })
        console.log("del request sent");
    });
}