import Alpine from "alpinejs";
import { route } from "ziggy-js";

document.addEventListener("alpine:init", () => {
    Alpine.data("adminNotification", () => ({
        notifications: [],
        unreadCount: 0,
        openNotif: false,

        async initData() {
            await this.fetchNotifications();
        },

        async fetchNotifications() {
            try {
                const response = await fetch(route("admin.notifications"));
                const result = await response.json();
                this.notifications = result.data.notifications;
                this.unreadCount = result.data.unread_count;
            } catch (error) {
                console.error("Error fetching notifications:", error);
            }
        },
    }));
});
