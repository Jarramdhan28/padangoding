const setNestedProperty = (obj, path, value) => {
    if (!path || typeof path !== "string") return false;
    const parts = path.split(".");
    const last = parts.pop();
    const context = parts.reduce((acc, part) => acc && acc[part], obj);

    if (context && last) {
        context[last] = value;
        return true;
    }
    return false;
};

export default function (Alpine) {
    Alpine.magic("delete", function () {
        return async function ({
            url,
            dispatch = "table",
            modalClose = null,
            toast = true,
        }) {
            this.loading = true;
            try {
                const response = await fetch(url, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                        Accept: "application/json",
                    },
                });

                const result = await response.json();

                if (!response.ok) {
                    this.$toast(result.message || "Validasi gagal", "error");
                } else {
                    if (toast === true) {
                        this.$toast(
                            result.message || "Berhasil!",
                            result.status || "success"
                        );
                    }

                    if (modalClose) {
                        setNestedProperty(this, modalClose, false);

                        if (this[modalClose] !== undefined) {
                            this[modalClose] = false;
                        }
                    }

                    if (this.$dispatch) {
                        this.$dispatch(dispatch);
                    }
                }
            } catch (error) {
                console.error("Gagal Menghapus Data", error);
            }
            this.loading = false;
        };
    });
}
