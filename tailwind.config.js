const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#110B56",
                secondary: "#F4F5FA",
                tertiary: "#2760F3",
                quaternary: "#6FC2F9",
                blueLight: "#5CBEFF",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
