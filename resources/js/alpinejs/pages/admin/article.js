import Alpine from "alpinejs";
import { route } from "ziggy-js";
import { readingTime } from "reading-time-estimator";

document.addEventListener("alpine:init", () => {
    Alpine.data("adminArticle", () => ({
        loading: false,
        isLoaded: false,
        errors: {},
        search: "",
        results: [],
        page: {
            currentPage: 1,
            lastPage: 1,
            total: 0,
            perPage: 1,
        },
        filterData: {
            open: false,
            selected: "review",
            options: ["review", "approved"],
        },

        async initData() {
            this.loading = true;
            this.isLoaded = false;
            await this.fetchResults();
            this.loading = false;
            this.isLoaded = true;

            this.$watch("filterData.selected", () => {
                this.fetchResults(1);
            });
        },

        selectedStatus(status) {
            this.filterData.selected = status;
            this.filterData.open = false;
        },

        async fetchResults(page = 1) {
            try {
                const response = await fetch(
                    route("admin.article.getData", {
                        search: this.search,
                        page: page,
                        filter: this.filterData.selected,
                    })
                );
                const result = await response.json();
                this.results = result.data;
                this.page.currentPage = result.meta.current_page;
                this.page.lastPage = result.meta.last_page;
                this.page.perPage = result.meta.per_page;
                this.page.total = result.meta.total;
            } catch (error) {
                console.error("Failed to load article data", error);
            }
        },
    }));

    Alpine.data("adminDetailArticle", () => ({
        loading: false,
        isLoaded: false,
        article: [],
        readTime: {},
        formStatus: {
            commentar: "",
            status: "",
        },
        errors: {},

        async initData() {
            this.isLoaded = false;
            await this.fethDetailArticle();
            this.isLoaded = true;
            console.log(this.formStatus.commentar);
        },

        async fethDetailArticle() {
            const slug = window.location.pathname.split("/").pop();

            try {
                const response = await fetch(
                    route("admin.article.getDetail", slug)
                );
                const result = await response.json();
                this.article = result.data;
                this.readTime = readingTime(result.data.content, 100);
            } catch (error) {
                console.error("Failed to load article detail", error);
            }
        },
    }));
});
