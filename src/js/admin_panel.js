const edit_btns = document.querySelectorAll('.edit-btn');
for (let btn of edit_btns) {
    btn.addEventListener('click', (e) => {
        const btnId = e.currentTarget.id;
        const id = btnId.split('-')[2];
        const input = document.getElementById("idUser-input-edit");
        input.value = id;
        
        const row = e.currentTarget.parentNode.parentNode;
        const cells = row.querySelectorAll('td');
        const inputs = document.querySelectorAll('.input-edit-user'); 
        for (let i = 0; i < cells.length && i < inputs.length; i++) {
            inputs[i].value = cells[i].textContent;
        }

        window.location.href = "#edit-user-section";

    });
}

const del_btns = document.querySelectorAll('.delete-btn');
for (let btn of del_btns) {
    btn.addEventListener('click', (e) => {
        const btnId = e.currentTarget.id;
        const idUser = btnId.split('-')[2];
        console.log("id: " + idUser);
        fetch('../actions/admin_panel/action_del_user.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ idUser: idUser })
        })
        console.log("del request sent");
    });
}