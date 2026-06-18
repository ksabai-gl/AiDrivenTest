import React from 'react'
import { Provider } from "react-redux";
import { store } from "@redux/store";
import { PopupProvider } from "@components/popups/PopupContext";
import { I18nProvider } from '@/i18n/I18nContext';
export default function Wrapper({
    children
}) {
    return <I18nProvider>
        <Provider store={store}>
            <PopupProvider>
                {children}
            </PopupProvider>
        </Provider>
    </I18nProvider>

}