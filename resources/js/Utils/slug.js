function slug(string) {
    return string
        .toLowerCase()
        .normalize('NFD') // Normalizes to decomposed form (NFD)
        .replace(/[\u0300-\u036f]/g, '') // Removes diacritics
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '') // Existing replacements
}

export default slug
