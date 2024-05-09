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