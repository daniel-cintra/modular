export default (componentName) => {
    if (componentName.startsWith('App'))
        return {
            from: `@/Components/${componentName}.vue`
        }
}
