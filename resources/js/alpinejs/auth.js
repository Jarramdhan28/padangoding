import Alpine from "alpinejs";

document.addEventListener("alpine:init", () => {
    Alpine.data("register", () => ({
        loading: false,
        errors: {},
        form: {
            data: {
                username: "",
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            },
            url: "/register",
            method: "POST",
        },
    }));

    Alpine.data("login", () => ({
        loading: false,
        errors: {},
        form: {
            data: {
                email: "",
                password: "",
            },
        },
    }));
});
