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
            id: 'divider'
        },
        {
            id: 'users',
            label: 'Kullanıcılar',
            type: 'route',
            link: 'user.index',
            icon: 'fa-solid fa-user-gear'
        },
        {
            id: 'roles',
            label: 'Roller',
            type: 'route',
            link: 'role.index',
            icon: 'fa-solid fa-user-shield'
        },
        {
            id: 'permissions',
            label: 'İzinler',
            type: 'route',
            link: 'permission.index',
            icon: 'fa-solid fa-key'
        },
        {
            id: 'divider'
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
