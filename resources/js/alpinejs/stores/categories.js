export default () => {
    document.addEventListener("alpine:init", () => {
        Alpine.store("categories", {
            list: [],
            isLoading: false,
            isLoaded: false,

            async fetchCategories() {
                if (this.isLoaded) return;
                this.isLoading = true;
                try {
                    const response = await fetch("/reference/categories");
                    if (!response.ok) {
                        throw new Error("Network response was not ok");
                    }
                    const data = await response.json();
                    this.list = data;
                    this.isLoaded = true;
                    this.isLoading = false;
                } catch (error) {
                    console.error("Error fetching categories:", error);
                } finally {
                    this.isLoading = false;
                }
            },
        });
    });
};
