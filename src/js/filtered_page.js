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
    }
}

filters = new Filters("Homem", "Calças", "L", null);

function applyFiltersHandler() {
    console.log('applyFiltersHandler() executed');
    
    type = filters.currFilterValues[0];
    category = filters.currFilterValues[1];
    size = filters.currFilterValues[2];
    orderBy = filters.currFilterValues[3];

    console.log("\ntype: " + type + "\ncategory: " + category + "\nsize: " + size + "\norderBy: "+ orderBy);
}

function cleanFiltersHandler() {
    console.log('cleanFiltersHandler() executed');
    document.getElementById('clean-filters').style = 'display: none;';
    filters.reset();
}

function changedFilterValueHandler(){
    console.log('changedFilterValueHandler() executed');
    filters.updateFilterValues();
    document.getElementById('clean-filters').style = 'display: flex;';
}
