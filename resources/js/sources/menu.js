import { ref } from "vue";

export default function () {
    const links = ref([
        {
            id: "post",
            label: "Yazı Yönetimi",
            type: "dropdown",
            icon: "fa-solid fa-trophy",
            items: [
                {
                    id: "post-index",
                    label: "Yazılar",
                    type: "route",
                    link: "post.index",
                    icon: "fa-solid fa-clipboard-list",
                },
                {
                    id: "post-create",
                    label: "Yazı Ekle",
                    type: "route",
                    link: "post.create",
                    icon: "fa-solid fa-plus",
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
