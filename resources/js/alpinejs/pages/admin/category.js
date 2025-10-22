import Alpine from "alpinejs";

document.addEventListener("alpine:init", () => {
    Alpine.data("adminCategory", () => ({
        loading: false,
        form: {
            modal: false,
            isEdit: false,
            data: {
                name: "",
                icon: null,
            },
            url: "",
            method: "",
        },
        previewUrl: null,
        errors: {},
        search: "",
        results: [],
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
            this.$watch("search", (value) => {
                if (value.trim().length >= 2 || value === "") {
                    this.fetchResults(1, value);
                }
            });
        },

        async fetchResults(page = 1) {
            try {
                const response = await fetch(
                    `/admin/referensi/category/get?page=${page}&search=${encodeURIComponent(
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
                console.error("Failed to load category data", error);
            }
        },

        openCreateModal() {
            this.form.data = {};
            this.previewUrl = null;
            this.form.modal = true;
            this.form.isEdit = false;
            this.form.method = "POST";
            this.form.url = "/admin/referensi/category";
        },

        closeFormModal() {
            this.form.modal = false;
            this.form.isEdit = false;
            this.errors = {};
            this.form.data = {};
            this.previewUrl = null;
        },

        openEditModal(data) {
            this.form.modal = true;
            this.form.isEdit = true;
            this.errors = {};
            this.form.data = { ...data };
            this.previewUrl = data.icon;
            this.form.method = "PUT";
            this.form.url = `/admin/referensi/category/${data.id}`;
        },

        openDeleteModal(data) {
            this.deleteData.modal = true;
            this.deleteData.data.name = data.name;
            this.deleteData.url = `/admin/referensi/category/${data.id}`;
        },

        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.data.icon = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewUrl = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
    }));
});
