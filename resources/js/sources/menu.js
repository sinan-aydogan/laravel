import { ref } from "vue";

export default function () {
    const links = ref([
        {
            id: "mrp",
            label: "Malzeme Yönetimi",
            type: "dropdown",
            icon: "fa-solid fa-clipboard-list",
            items: [
                {
                    id: "mrp-pr",
                    label: "Ürünler",
                    type: "route",
                    link: "product.index",
                    icon: "fa-solid fa-circle",
                },
                {
                    id: "mrp-rw",
                    label: "Hammaddeler",
                    type: "route",
                    link: "raw-material.index",
                    icon: "fa-solid fa-shapes",
                },
            ],
        },
        {
            id: "qa",
            label: "Kalite",
            type: "dropdown",
            icon: "fa-solid fa-trophy",
            items: [
                {
                    id: "qa-tool",
                    label: "Ölçü Aletleri",
                    type: "route",
                    link: "tool.index",
                    icon: "fa-solid fa-plus",
                },
                {
                    id: "qa-certificate",
                    label: "Sertifikalar",
                    type: "route",
                    link: "certificate.index",
                    icon: "fa-solid fa-certificate",
                },
            ],
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
