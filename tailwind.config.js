/** @type {import('tailwindcss').Config} */
import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms"; 
import lineClamp from "@tailwindcss/line-clamp";

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
            height: {
                '50dvh': '50dvh', // Add custom height utility for 50dvh
            },
        },
    },
    plugins: [
        forms,
        lineClamp,
    ],
};
