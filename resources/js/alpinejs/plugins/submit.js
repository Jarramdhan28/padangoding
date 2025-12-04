const setNestedProperty = (obj, path, value) => {
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
    Alpine.magic("submit", function () {
        return async function ({
            url,
            method = "POST",
            data = {},
            modalClose = null,
            dispatch = null,
            redirect = null,
            toast = true,
        }) {
            this.loading = true;
            try {
                const formData = new FormData();

                let actualMethod = method.toUpperCase();
                if (["PUT", "PATCH", "DELETE"].includes(actualMethod)) {
                    formData.append("_method", actualMethod);
                    actualMethod = "POST";
                }

                Object.entries(data).forEach(([key, value]) => {
                    if (
                        value === null ||
                        value === undefined ||
                        value === "" ||
                        value === "null"
                    ) {
                        return;
                    }

                    if (Array.isArray(value)) {
                        value.forEach((item) =>
                            formData.append(`${key}[]`, item)
                        );
                    } else {
                        formData.append(key, value);
                    }
                });

                const response = await fetch(url, {
                    method: actualMethod,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                        Accept: "application/json",
                    },
                    body: formData,
                });

                const result = await response.json().catch(() => ({}));

                if (!response.ok || result.status === "error") {
                    if (response.status === 422) {
                        this.errors = result.errors ?? {};
                        this.$toast(
                            result.message || "Validasi gagal",
                            "error"
                        );
                    } else {
                        this.$toast(
                            result.message || "Terjadi kesalahan pada server",
                            "error"
                        );
                    }
                } else {
                    this.errors = {};
                    if (toast === true) {
                        this.$toast(
                            result.message || "Berhasil!",
                            result.status || "success"
                        );
                    }

                    if (result.redirect !== undefined) {
                        setTimeout(() => {
                            window.location.href = result.redirect;
                        }, 1000);
                    }

                    if (modalClose) {
                        setNestedProperty(this, modalClose, false);
                        if (this[modalClose] !== undefined) {
                            this[modalClose] = false;
                        }
                    }

                    if (dispatch) {
                        this.$dispatch(dispatch);
                    }

                    if (redirect) {
                        setTimeout(() => {
                            window.location.href = redirect;
                        }, 1000);
                    }
                }
            } catch (error) {
                console.error(error);
                this.$toast("Gagal mengirim data ke server", "error");
            }
            this.loading = false;
        };
    });
}
