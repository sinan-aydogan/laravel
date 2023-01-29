import { ref } from "vue";

export default function () {
    const links = ref([
        {
            id: 'transaction',
            label: 'Stok Hareketleri',
            type: 'route',
            link: 'transaction.index',
            icon: 'fa-solid fa-truck'
        },
        {
            id: 'stockCard',
            label: 'Stok Listesi',
            type: 'route',
            link: 'stockCard.index',
            icon: 'fa-solid fa-list'
        },
        {
            id: 'warehouse',
            label: 'Depolar',
            type: 'route',
            link: 'warehouse.index',
            icon: 'fa-solid fa-warehouse'
        },
        {
            id: 'product',
            label: 'Ürünler',
            type: 'route',
            link: 'product.index',
            icon: 'fa-solid fa-box'
        },
        {
            id: "help",
            label: "Yardım",
            type: "link",
            link: "http://udemy.com",
            target: "_blank",
            icon: "fa-solid fa-life-ring",
        },
    ]);

    return {
        links,
    };
}
