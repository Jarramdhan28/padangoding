import Alpine from "alpinejs";

document.addEventListener("alpine:init", () => {
    Alpine.data("userManagement", () => ({
        loading: false,
        errors: {},
        search: "",
        results: [],
        page: {
            currentPage: 1,
            lastPage: 1,
            total: 0,
            perPage: 10,
        },
        dropdownOpen: false,
        roleList: [],
        setRole: {
            modal: false,
            data: {
                role_id: "",
            },
            url: "",
        },

        async initData() {
            this.loading = true;
            await this.fetchResults();
            await this.fetchRoles();
            this.loading = false;
            this.$watch("search", (value) => {
                if (value.trim().length >= 2 || value === "") {
                    this.fetchResults(1, value);
                }
            });
        },

        async fetchResults(page = 1) {
            try {
                const response = await fetch(
                    `/admin/user-management/get?page=${page}&search=${this.search.trim()}`
                );
                const result = await response.json();
                console.log(result);
                this.results = result.data;
                this.page.currentPage = result.meta.current_page;
                this.page.lastPage = result.meta.last_page;
                this.page.perPage = result.meta.per_page;
                this.page.total = result.meta.total;
            } catch (error) {
                console.error("Failed to load category data", error);
            }
        },

        async fetchRoles() {
            try {
                const response = await fetch(`/admin/user-management/roles`);
                this.roleList = await response.json();
            } catch (error) {
                console.error("Failed to load roles", error);
            }
        },

        openModalSetRole(user) {
            this.setRole.modal = true;
            this.setRole.data.role_id = user.role_id[0];
            this.setRole.url = `/admin/user-management/set-role/${user.id}`;
        },
    }));
});
