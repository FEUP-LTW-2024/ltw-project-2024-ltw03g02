const edit_btns = document.querySelectorAll('.edit-btn');
for (let btn of edit_btns) {
    btn.addEventListener('click', (e) => {
        const btnId = e.currentTarget.id;
        const id = btnId.split('-')[2];
        console.log("id: " + id);
        const input = document.getElementById("id-input-edit");
        input.value = id;
        
        const row = e.currentTarget.parentNode.parentNode;
        const cells = row.querySelectorAll('td');
        const inputs = document.querySelectorAll('.input-edit-row'); 
        for (let i = 0; i < cells.length && i < inputs.length; i++) {
            inputs[i].value = cells[i].textContent;
        }

        window.location.href = "#edit-row-section";

    });
}

const del_btns = document.querySelectorAll('.delete-btn');
for (let btn of del_btns) {
    btn.addEventListener('click', (e) => {
        const btnId = e.currentTarget.id;
        const id = btnId.split('-')[2];
        console.log("id: " + id);
        let state = new URLSearchParams(window.location.search).get('state');
        let url;

        if (state === 'users') {
            url = '../actions/admin_panel/action_del_user.php';
        } else if (state === 'items') {
            url = '../actions/admin_panel/action_del_item.php';
        } else {
            url = '../actions/admin_panel/action_del_category.php';
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: id})
        }).then(() => {
                console.log("del request sent");
                window.location.reload(true);
            }
        );
    });
}