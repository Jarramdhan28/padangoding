import Alpine from "alpinejs";
import { route } from "ziggy-js";

document.addEventListener("alpine:init", () => {
    Alpine.data("creatorProfile", () => ({
        loading: false,
        loadingPage: false,
        form: {
            data: {
                username: "",
                name: "",
                email: "",
                bio: "",
            },
        },
        errors: {},
        modalCropImage: false,
        cropImage: null,
        imagePreview: null,
        imageProfile: null,

        async initData() {
            this.loadingPage = true;
            await this.getProfileData();
            this.loadingPage = false;
        },

        async getProfileData() {
            try {
                const response = await fetch(route("creator.profile.getData"));
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                const result = await response.json();
                this.form.data = result.data;
            } catch (error) {
                console.error(
                    "There was a problem with the fetch operation:",
                    error
                );
            }
        },

        uploadProfile(event) {
            const file = event.target.files[0];
            if (file) {
                const maxSize = 500 * 1024; // 500KB
                if (file.size > maxSize) {
                    this.$toast("File jangan melebihi 500KB", "error");
                    return;
                }
                this.imagePreview = URL.createObjectURL(file);
                this.modalCropImage = true;
                this.$nextTick(() => {
                    if (this.cropImage) {
                        this.cropImage.destroy();
                    }

                    const profileImage = this.$refs.profileImage;
                    this.cropImage = new Cropper(profileImage, {
                        aspectRatio: 1,
                        viewMode: 1,
                        responsive: true,
                        autoCropArea: 1,
                        zoomable: true,
                        background: false,
                    });
                });
            }
        },

        async uploadProfileImage() {
            if (!this.cropImage) {
                this.$toast("Tidak ada gambar untuk di upload", "error");
                return;
            }

            const canvas = this.cropImage.getCroppedCanvas({
                width: 500,
                height: 500,
            });

            const profileUpload = await new Promise((resolve) => {
                canvas.toBlob((blob) => {
                    resolve(blob);
                }, "image/jpeg");
            });

            this.$submit({
                url: route("creator.profile.uploadProfile"),
                method: "POST",
                data: { profile: profileUpload },
                modalClose: this.modalCropImage,
                dispatch: "profile-updated",
            });
        },
    }));
});
