import { defineStore } from "pinia";

export const useNotification = defineStore("notification", {
    state: () => ({
        notifications: [],
    }),
    actions: {
        add(value) {
            let id = Number(new Date().getTime()) + Math.random();
            value["id"] = id;

            this.notifications.push(value);
        },
        delete(value) {
            let index = this.notifications.findIndex((i) => i.id === value.id);

            this.notifications.splice(index, 1);
        },
    },
});
