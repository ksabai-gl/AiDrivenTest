import en from "./en";
import vi from "./vi";
import ja from "./ja";
/**
 * Autoload all file languages at extension 
 */
const modules = import.meta.glob('../../../../extensions/**/Resources/js/i18n/**/*.js', { eager: true });

function loadMessages(locale) {
    const messages = {};

    Object.entries(modules).forEach(([path, module]) => {
        if (path.includes(`/i18n/${locale}`)) {
            Object.assign(messages, module.default || {});
        }
    });

    return messages;
}
/**
 * Merge all file same language
 */
export const i18nMessages = { 
    vi: {
        ...loadMessages('vi'),
        ...vi
    },
    en: {
        ...loadMessages('en'),
        ...en
    },
    ja: {
        ...loadMessages('ja'),
        ...ja
    },
};
