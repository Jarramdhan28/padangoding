import Alpine from "alpinejs";

document.addEventListener("alpine:init", () => {
    Alpine.data("adminTag", () => ({
        loading: false,
        form: {
            modal: false,
            data: {
                id: null,
                name: "",
            },
            isEdit: false,
            url: "",
            method: "",
        },
        errors: {},
        results: [],
        search: "",
        page: {
            currentPage: 1,
            lastPage: 1,
            total: 0,
            perPage: 10,
        },
        deleteData: {
            modal: false,
            url: "",
            data: {
                id: null,
                name: "",
            },
        },

        async initData() {
            this.loading = true;
            await this.fetchResults();
            this.loading = false;
            this.$watch("search", () => this.fetchResults(1));
        },

        async fetchResults(page = 1) {
            try {
                const response = await fetch(
                    `/admin/referensi/tag/get?page=${page}&search=${encodeURIComponent(
                        this.search
                    )}`
                );
                const result = await response.json();
                this.results = result.data;
                this.page.currentPage = result.meta.current_page;
                this.page.lastPage = result.meta.last_page;
                this.page.perPage = result.meta.per_page;
                this.page.total = result.meta.total;
            } catch (error) {
                console.error("Gagal memuat data tag", error);
            }
        },

        openCreateModal() {
            this.form.data = {};
            this.form.modal = true;
            this.form.isEdit = false;
            this.form.url = "/admin/referensi/tag";
            this.form.method = "POST";
        },

        closeFormModal() {
            this.form.modal = false;
            this.form.isEdit = false;
            this.errors = {};
            this.form.data = {};
        },

        openEditModal(data) {
            this.form.modal = true;
            this.form.isEdit = true;
            this.errors = {};
            this.form.data = { ...data };
            this.form.method = "PUT";
            this.form.url = `/admin/referensi/tag/${data.id}`;
        },

        openDeleteModal(data) {
            this.deleteData.modal = true;
            this.deleteData.data.name = data.name;
            this.deleteData.url = `/admin/referensi/tag/${data.id}`;
        },
    }));
});
