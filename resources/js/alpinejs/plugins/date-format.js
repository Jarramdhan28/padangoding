export default function (Alpine) {
    Alpine.magic("timeAgoFormat", () => {
        return (tanggalString) => {
            if (!tanggalString) return "-";
            const date = new Date(tanggalString);
            if (isNaN(date.getTime())) return "-";
            const now = new Date();
            const diff = (now - date) / 1000;

            if (diff < 60) return "beberapa detik yang lalu";
            if (diff < 3600) return `${Math.floor(diff / 60)} menit yang lalu`;
            if (diff < 86400) return `${Math.floor(diff / 3600)} jam yang lalu`;
            if (diff < 2592000)
                return `${Math.floor(diff / 86400)} hari yang lalu`;
            if (diff < 31536000)
                return `${Math.floor(diff / 2592000)} bulan yang lalu`;
            return `${Math.floor(diff / 31536000)} tahun yang lalu`;
        };
    });

    Alpine.magic("longDateFormat", () => {
        return (tanggalString) => {
            if (!tanggalString) return "-";
            const tanggal = new Date(tanggalString);
            if (isNaN(tanggal.getTime())) return "-";
            return new Intl.DateTimeFormat("id-ID", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            }).format(tanggal);
        };
    });
}
