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

function _createFetchString() {
    let fetchString = '../api/api_filter_items.php?';
    let filterNames = ['type_item', 'categoryId', 'clotheSize', 'orderBy'];
    filters.currFilterValues.forEach((value, index) => {
        if (value != null){
            fetchString += filterNames[index] + '=' + value + '&';
        }
    });
    const urlParams = new URLSearchParams(window.location.searchTerm);
    if (urlParams.has('searchTerm')){
        fetchString += 'searchTerm=' + urlParams.get('searchTerm') + '&';
    }
    return fetchString;
}

function _drawItemCard(item) {
    const itemCard = document.createElement('div');
    itemCard.classList.add('item-card');
    itemCard.innerHTML = `
        <img src="${item['picture']}">
        <button class="icon-btn buy-btn"><img src="../../images/icon_btn/cart_plus_solid.svg" /></button>
        <div class="item-card-info">
            <div>
                <img src="${item['profile_image_link']}" />
                <span>${item['username']}</span>
            </div>
            <span class="price-info">€ ${item['price']}</span>
            <span class="size-info">${item['sizeName']}</span>
            <span class="type-info">${item['type_item']}</span>
            <span class="category-info">${item['categoryName']}</span>
        </div>
    `;
    return itemCard;
}

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

    for (item of items){
        itemList.appendChild(_drawItemCard(item));
    }
}

function cleanFiltersHandler() {
    console.log('cleanFiltersHandler() executed');
    document.getElementById('clean-filters').style = 'visibility: hidden;';
    filters.reset();
    loadItems();

    window.location.href = '/pages/filtered_page.php';
}

function changedFilterValueHandler(){
    console.log('changedFilterValueHandler() executed');
    filters.updateFilterValues();
    if (filters.isEmpty()){
        document.getElementById('clean-filters').style = 'visibility: hidden;';
    } else {
        document.getElementById('clean-filters').style = 'visibility: visible;';
    }
    console.log('applyFiltersHandler() executed');
    loadItems();
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