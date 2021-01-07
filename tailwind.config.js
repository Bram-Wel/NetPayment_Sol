// const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    presets: [
        require('./vendor/tanthammar/tall-forms/resources/stubs/tailwindcss/1.9/tall-forms-preset.js'),
    ],
    future: {
        // Upcoming changes for TailwindCSS v2
        removeDeprecatedGapUtilities: true,
        purgeLayersByDefault: true,
        // defaultLineHeights: true,
        // standardFontWeights: true,
    },
    experimental: {
        applyComplexClasses: true,
    },

    theme: {
        extend: {}
    },

    variants: {},

    plugins: [
            require('@tailwindcss/ui')({
                layout: 'sidebar',
            }),
            require('@tailwindcss/typography'),
    ],
};
