import Alpine from "alpinejs";
import Quill from "quill";
import { route } from "ziggy-js";
import { readingTime } from "reading-time-estimator";

document.addEventListener("alpine:init", () => {
    Alpine.data("articleCreate", () => ({
        loading: false,
        loadingPage: false,
        isEditMode: false,
        form: {
            data: {
                thumbnail: null,
                title: "",
                content: "",
                category_id: "",
                status: "",
                description: "",
            },
            url: "",
            method: "",
        },
        errors: {},
        textEditor: null,
        previewThumbnail: null,

        async initFormData() {
            this.loadingPage = true;
            const slug = window.location.pathname.split("/").pop();
            this.$store.categories.fetchCategories();

            if (!slug || slug === "create-article") {
                this.isEditMode = false;
                this.form.url = route("creator.article.store");
                this.form.method = "POST";
                this.$nextTick(() => {
                    this.textEditor.root.innerHTML =
                        this.form.data.content || "";
                });
            } else {
                this.isEditMode = true;
                this.form.url = route("creator.article.update", slug);
                this.form.method = "PUT";

                const response = await fetch(
                    route("creator.article.getArticleBySlug", slug)
                );
                const data = await response.json();
                const article = data.data;
                this.form.data.title = article.title;
                this.form.data.category_id = article.category.id;
                this.$nextTick(() => {
                    this.textEditor.root.innerHTML = article.content;
                });
                this.previewThumbnail = article.thumbnail;
            }
            this.loadingPage = false;
        },

        initdata() {
            this.initFormData();
            this.initTextEditor();
        },

        initTextEditor() {
            this.textEditor = new Quill("#content", {
                placeholder: "Tulis konten artikel di sini...",
                theme: "snow",
                modules: {
                    toolbar: [
                        [{ header: [2, 3, false] }],
                        [{ align: [] }],
                        ["bold", "italic", "underline", "strike"],
                        [
                            { list: "ordered" },
                            { list: "bullet" },
                            { list: "check" },
                        ],
                        ["link", "image"],
                        ["code-block", "blockquote"],
                        [{ script: "sub" }, { script: "super" }],
                    ],
                },
            });

            this.textEditor.on("text-change", () => {
                this.form.data.content = this.textEditor.root.innerHTML;
            });
        },

        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.data.thumbnail = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.previewThumbnail = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
    }));

    Alpine.data("articleHandler", () => ({
        loading: false,
        search: "",
        results: [],
        page: {
            currentPage: 1,
            lastPage: 1,
            total: 0,
            perPage: 12,
        },
        data: {},

        async initData() {
            await this.fetchArticles();
            this.$watch("search", (value) => {
                if (value.trim().length >= 2 || value === "") {
                    this.fetchArticles(1, value);
                }
            });
        },

        async fetchArticles(page = 1) {
            try {
                const params = new URLSearchParams({
                    search: this.search,
                    page: page,
                });

                const baseRoute = route("creator.get");
                const url = `${baseRoute}?${params.toString()}`;
                const response = await fetch(url);
                const result = await response.json();
                this.results = result.data;
                console.log(this.results);
                this.page.currentPage = result.meta.current_page;
                this.page.lastPage = result.meta.last_page;
                this.page.perPage = result.meta.per_page;
                this.page.total = result.meta.total;
            } catch (error) {
                console.log("Failed to load articles data", error);
            }
        },
    }));

    Alpine.data("detailArticle", () => ({
        loadingPage: false,
        article: {},
        readTime: {},

        async initData() {
            await this.fetchArticle();
        },

        async fetchArticle() {
            const slug = window.location.pathname.split("/").pop();

            try {
                const baseRoute = route(
                    "creator.article.getArticleBySlug",
                    slug
                );
                const response = await fetch(baseRoute);
                const article = await response.json();
                this.article = article.data;
                this.readTime = readingTime(article.data.content, 100);
            } catch (error) {
                console.error("Gagal memuat data article", error);
            }
        },
    }));
});
