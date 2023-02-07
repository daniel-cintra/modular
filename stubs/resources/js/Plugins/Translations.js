export default {
    install: (app, options) => {
        const __ = (key, replacements = {}) => {
            let translation = window._translations[key] || key

            Object.keys(replacements).forEach((replacement) => {
                translation = translation.replace(
                    `:${replacement}`,
                    replacements[replacement]
                )
            })

            return translation
        }

        app.config.globalProperties.__ = __

        app.provide('translate', __)
    }
}
