async function isLoggedIn() {
    const response = await fetch('../actions/cart/is_logged_in.php');
    const isLoggedIn = await response.text();
    return isLoggedIn === 'true';
}

isLoggedIn().then(isLoggedIn => {
    if (isLoggedIn) {
        console.log('User is logged in');
    } else {
        console.log('User is not logged in');
    }
});

class Filters {
    constructor(type, category, size, orderBy){
        this.filtersList = [
            "type-filter-select",
            "category-filter-select",
            "size-filter-select",
            "order-by-filter-select"
        ];

        this.currFilterValues = [
            type,
            category,
            size,
            orderBy
        ]
    }
    
    isEmpty() {
        return this.currFilterValues.every(value => value === null);
    }
    
    reset() {
        for (let filter of this.filtersList){
            document.getElementById(filter).selectedIndex = 0;
        }
        this.currFilterValues = [null, null, null, null];
    }
    
    updateFilterValues(){
        this.currFilterValues = [
            document.getElementById("type-filter-select").value,
            document.getElementById("category-filter-select").value,
            document.getElementById("size-filter-select").value,
            document.getElementById("order-by-filter-select").value
        ];
        for(let i = 0; i < this.currFilterValues.length; i++){
            if (this.currFilterValues[i] == ""){
                this.currFilterValues[i] = null;
            }
        }
        console.log(this.currFilterValues);
    }
}

filters = new Filters(null, null, null, null);

// ******************* LEGACY CODE ******************* //
// function _createFetchString() {
//     let fetchString = '../api/api_filter_items.php?';
//     let filterNames = ['type_item', 'categoryId', 'clotheSize', 'orderBy'];
//     filters.currFilterValues.forEach((value, index) => {
//         if (value != null){
//             fetchString += filterNames[index] + '=' + value + '&';
//         }
//     });
//     const urlParams = new URLSearchParams(window.location.searchTerm);
//     if (urlParams.has('searchTerm')){
//         fetchString += 'searchTerm=' + urlParams.get('searchTerm') + '&';
//     }

//     return fetchString;
// }

// function _drawItemCard(item, loggedIn) {
//     const itemCard = document.createElement('div');
//     itemCard.classList.add('item-card');
//     if(loggedIn) {
//         buyBtn = `<button class="icon-btn buy-btn" onclick="buyBtnPressedHandler(${item['idItem']});"><img src="../../images/icon_btn/cart_plus_solid.svg" /></button>`;
//     } else {
//         buyBtn = '';
//     }
//     itemCard.innerHTML = `
//         <a href="../pages/show_item.php?idItem=${item['idItem']}">
//             <img src="${item['picture']}">
//         </a>
//         ` + buyBtn + 
//         `
//         <div class="item-card-info">
//             <div>
//                 <img src="${item['profile_image_link']}" />
//                 <span>${item['username']}</span>
//             </div>
//             <span class="price-info">€ ${item['price']}</span>
//             <span class="size-info">${item['sizeName']}</span>
//             <span class="type-info">${item['type_item']}</span>
//             <span class="category-info">${item['categoryName']}</span>
//         </div>
//     `;
//     return itemCard;
// }

// function changedFilterValueHandler(){
//     console.log('changedFilterValueHandler() executed');
//     filters.updateFilterValues();
//     if (filters.isEmpty() && !new URLSearchParams(window.location.search).has('searchTerm')){
//         document.getElementById('clean-filters').style = 'visibility: hidden;';
//     } else {
//         document.getElementById('clean-filters').style = 'visibility: visible;';
//     }
//     console.log('applyFiltersHandler() executed');
//     loadItems();
// }
// ******************* LEGACY CODE ******************* //

async function loadItems() {
    const response = await fetch(_createFetchString(), {
        method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
    });
    const items = await response.json();

    itemList = document.querySelector('.item-list');
    itemList.innerHTML = '';
    
    isLoggedIn().then(isLoggedIn => {
        for (item of items){
            itemList.appendChild(_drawItemCard(item, isLoggedIn));
        }
    });
}

function cleanFiltersHandler() {
    console.log('cleanFiltersHandler() executed');
    document.getElementById('clean-filters').style = 'visibility: hidden;';
    filters.reset();
    loadItems();

    window.location.href = '/pages/filtered_page.php';
}

function resetPages(url) {
    if (url.searchParams.has('pageNum')) {
        url.searchParams.delete('pageNum');
    }
}

function changedFilterValueHandler(filterName){
    console.log('changedFilterValueHandler() executed');
    filters.updateFilterValues();   

    switch(filterName){
        case 'type-filter-select':
            var selectElement = document.getElementById('type-filter-select');
            var selectedValue = selectElement.value;
            var url = new URL(window.location.href);
            if (selectedValue === "") {
                url.searchParams.delete('type_item');
                resetPages(url);
            } else {
                url.searchParams.set('type_item', selectedValue);
                resetPages(url);
            }
            window.location.href = url.toString();
            break;
        case 'category-filter-select':
            var selectElement = document.getElementById('category-filter-select');
            var selectedValue = selectElement.value;
            var url = new URL(window.location.href);
            if (selectedValue === "") {
                url.searchParams.delete('idCategory');
                resetPages(url);

            } else {
                url.searchParams.set('idCategory', selectedValue);
                resetPages(url);
            }
            window.location.href = url.toString();
            break;
        case 'size-filter-select':
            var selectElement = document.getElementById('size-filter-select');
            var selectedValue = selectElement.value;
            var url = new URL(window.location.href);
            if (selectedValue === "") {
                url.searchParams.delete('clotheSize');
                resetPages(url);
            } else {
                url.searchParams.set('clotheSize', selectedValue);
                resetPages(url);
            }
            window.location.href = url.toString();
            break;
        case 'order-by-filter-select':
            var selectElement = document.getElementById('order-by-filter-select');
            var selectedValue = selectElement.value;
            var url = new URL(window.location.href);
            if (selectedValue === "") {
                url.searchParams.delete('orderBy');
                resetPages(url);
            } else {
                url.searchParams.set('orderBy', selectedValue);
                resetPages(url);
            }
            window.location.href = url.toString();
            break;
    }
    
}

window.onload = function() {
    let params = new URLSearchParams(location.search);
    let searchTerm = params.get('searchTerm');

    if (searchTerm) {
        document.getElementById('clean-filters').style.visibility = 'visible';
    } else {
        document.getElementById('clean-filters').style.visibility = 'hidden';
    }
}