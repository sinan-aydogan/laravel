import { defineStore } from "pinia";

export const useStore = defineStore("main", {
    state: () => ({
        activeLink: "",
        showMenu: true,
    }),
    actions: {
        setActiveLink(id) {
            this.activeLink = id;
        },
        toggleMenu() {
            this.showMenu = !this.showMenu;
        },
    },
});
